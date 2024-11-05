<?php
namespace App\Filament\Pages\Tenancy;

use App\Models\Almacen;
use App\Models\Producto;
use App\Models\Sitio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterAlmacen extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Registro de almacen';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('lat')
                    ->required()
                    ->maxLength(255),
                TextInput::make('lon')
                    ->required()
                    ->maxLength(255),
                Select::make('stitios')
                    ->relationship('sitios', 'name')
                    ->multiple()
                    ->searchable()
                    ->createOptionForm(Sitio::getForm())
                    ->preload(),
                Select::make('productos')
                    ->relationship('productos', 'name')
                    ->multiple()
                    ->searchable()
                    ->createOptionForm(Producto::getForm())
                    ->preload(),
                Select::make('usuarios')
                    ->relationship('users', 'email')
                    ->multiple()
                    ->searchable()
                    // ->createOptionForm(Sitio::getForm())
                    ->preload(),
            ]);
    }

    protected function handleRegistration(array $data):Almacen
    {
        $team = Almacen::create($data);

        $team->members()->attach(auth()->user());

        return $team;
    }
}
