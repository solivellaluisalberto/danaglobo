<?php

namespace App\Livewire;

use App\Models\Almacen;
use Livewire\Component;

class Home extends Component
{

    public function redirectClick($id)
    {
        return redirect()->to('/detalle/'.$id);
    }

    public function render()
    {
        $almacenes = Almacen::orderBy('name', 'asc')->get();
        return view('livewire.home')->with([
            'almacenes' => $almacenes
        ]);
    }
}
