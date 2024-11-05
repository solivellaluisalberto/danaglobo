<?php

namespace App\Livewire;

use App\Models\Almacen;
use Livewire\Component;

class Detail extends Component
{
    public Almacen $almacen;

    public $productsOrder = [];

    public $form = [
        'phone' => '',
        'address' => ''
    ];

    public function addToOrder($product)
    {
        $this->productsOrder[] = $product;
    }

    public function removeProduct($index)
    {
        array_splice($this->productsOrder, $index, 1);
    }

    public function render()
    {
        return view('livewire.detail')->with([
            'productos' => $this->almacen->productos()->orderBy('name', 'asc')->get(),
            'productsOrder' => $this->productsOrder
        ]);
    }
}
