<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class Sitio extends Model
{
    protected $table = 'sitios';

    protected $fillable = [
        'name'
    ];

    public static function getForm(){
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
        ];
    }
}
