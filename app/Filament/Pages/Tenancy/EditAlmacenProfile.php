<?php
namespace App\Filament\Pages\Tenancy;

use App\Models\Producto;
use App\Models\Sitio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EditAlmacenProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Editar almacen';
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

    public static function canView(Model $tenant): bool
    {
        return true; //Auth::user()->hasRole('superadmin');
    }

}
