<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlmacenResource\Pages;
use App\Filament\Resources\AlmacenResource\RelationManagers;
use App\Models\Almacen;
use App\Models\Producto;
use App\Models\Sitio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlmacenResource extends Resource
{
    protected static ?string $model = Almacen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lon')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('stitios')
                    ->relationship('sitios', 'name')
                    ->multiple()
                    ->searchable()
                    ->createOptionForm(Sitio::getForm())
                    ->preload(),
                Forms\Components\Select::make('productos')
                    ->relationship('productos', 'name')
                    ->multiple()
                    ->searchable()
                    ->createOptionForm(Producto::getForm())
                    ->preload(),
                Forms\Components\Select::make('usuarios')
                    ->relationship('users', 'email')
                    ->multiple()
                    ->searchable()
                    // ->createOptionForm(Sitio::getForm())
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sitios.name')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('users.email')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('productos.name')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListAlmacens::route('/'),
            //'create' => Pages\CreateAlmacen::route('/create'),
            //'edit' => Pages\EditAlmacen::route('/{record}/edit'),
        ];
    }
}
