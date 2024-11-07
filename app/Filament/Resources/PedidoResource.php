<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Models\Pedido;
use App\Models\Sitio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $tenantOwnershipRelationshipName = 'almacen';
    protected static ?string $tenantRelationshipName = 'pedidos';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255) ->required(),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255)->required(),
                Forms\Components\Select::make('productos')
                    ->relationship('productos', 'name')
                    ->multiple()
                    ->searchable()
                    // ->createOptionForm(Sitio::getForm())
                    ->preload(),
                Forms\Components\Select::make('almacen_id')->relationship('almacen', 'name') ->required(),
                Forms\Components\Select::make('voluntario_id')->relationship('voluntario', 'phone')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hora_estimada_recogida')
                    ->searchable(),
                Tables\Columns\TextColumn::make('productos')
                    ->formatStateUsing(
                        function ($record) {
                            $productCounts = [];
                        
                            // Contamos la cantidad de cada producto
                            foreach ($record->productos as $producto) {
                                if (isset($productCounts[$producto->name])) {
                                    $productCounts[$producto->name]++;
                                } else {
                                    $productCounts[$producto->name] = 1;
                                }
                            }
                        
                            // Construimos el string de lista de productos
                            $productList = '';
                            foreach ($productCounts as $name => $count) {
                                $productList .= "| {$name} x{$count} ";
                            }
                        
                            return $productList;
                        }
                    ),
                Tables\Columns\TextColumn::make('almacen.name')
                    ->badge()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('enviado')->sortable(),
                Tables\Columns\ToggleColumn::make('entregado')->sortable(),
                Tables\Columns\TextColumn::make('voluntario.name'),
                Tables\Columns\TextColumn::make('observaciones')
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }
}
