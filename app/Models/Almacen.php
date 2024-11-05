<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacen';

    protected $fillable = [
        'name',
        'lat',
        'lon'
    ];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'almacen_pedido', 'almacen_id', 'pedido_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'almacen_user', 'almacen_id', 'user_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'almacen_producto', 'almacen_id', 'producto_id');
    }
}
