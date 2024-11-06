<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Pedido;
use Livewire\Component;

class Test extends Component
{
    public function render()
    {
        $pedidos = Pedido::orderBy('created_at', 'desc')->get();
        return view('livewire.test')->with([
            'pedidos' => $pedidos
        ]);
    }
}
