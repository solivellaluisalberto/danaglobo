<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'name'
    ];

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
        ];
    }
}

