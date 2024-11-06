<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'phone',
        'address',
        'almacen_id',
        'enviado',
        'entregado',
        'hora_estimada_recogida',
        'voluntario_id'
    ];

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }

    public function voluntario()
    {
        return $this->belongsTo(Voluntario::class);
    }
}

