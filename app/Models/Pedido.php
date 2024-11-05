<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'phone',
        'address',
        'almacen_id'
    ];

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}

