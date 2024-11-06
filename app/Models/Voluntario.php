<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    protected $table = 'voluntarios';

    protected $fillable = [
        'phone'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
