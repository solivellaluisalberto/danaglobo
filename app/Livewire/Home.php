<?php

namespace App\Livewire;

use App\Models\Almacen;
use Livewire\Component;

class Home extends Component
{


    public function render()
    {
        $almacenes = Almacen::all();
        return view('livewire.home')->with([
            'almacenes' => $almacenes
        ]);
    }
}
