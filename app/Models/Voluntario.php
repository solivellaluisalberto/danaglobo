<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Voluntario extends Authenticatable
{
    protected $table = 'voluntarios';

    protected $fillable = [
        'phone',
        'name'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
