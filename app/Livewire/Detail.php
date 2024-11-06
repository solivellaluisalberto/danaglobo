<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Pedido;
use App\Models\Producto;
use Livewire\Component;

class Detail extends Component
{
    public Almacen $almacen;

    public $productos;
    public $productosSearch;

    public function mount()
    {
        $this->productos = $this->almacen->productos()->orderBy('name', 'asc')->get();
        $this->productosSearch = $this->productos;
    }

    public function redirectClick()
    {
        return redirect()->to('/');
    }

    public $productsOrder = [];

    public $form = [
        'phone' => '',
        'address' => ''
    ];

    public $searchTerm = "";

    public function updatedSearchTerm()
    {
        $collection = collect($this->productos);
        $property = 'name';

        // Filtramos los items que contienen el término de búsqueda en la propiedad especificada
        $this->productosSearch = $collection->filter(function ($item) use ($property) {
            // Verificamos si la propiedad existe y contiene el término de búsqueda (sin distinción de mayúsculas)
            return isset($item->$property) && stripos($item->$property, $this->searchTerm) !== false;
        });

    }

    public function addToOrder($product)
    {
        $this->productsOrder[] = $product;
    }

    public function removeProduct($index)
    {
        array_splice($this->productsOrder, $index, 1);
    }

    public $orderCompleted = false;
    public $errorMessage = "";

    public function submitForm() {

        if ($this->form['phone'] && $this->form['address'])  {
            $order = Pedido::create([
                'phone' => $this->form['phone'],
                'address' => $this->form['address'],
                'almacen_id' => $this->almacen->id
            ]);
            foreach ($this->productsOrder as $p) {
                $order->productos()->attach($p['id']);
            }
            $this->orderCompleted = true;
            $this->form = [
                'phone' => '',
                'address' => ''
            ];
            $this->productsOrder = [];
        } else {
            $this->errorMessage = 'Hay algún error en el formulario, asegurate de poner un teléfono válido.';
        }


    }

    public function resetForm()
    {
        $this->orderCompleted = false;
    }

    public function render()
    {
        return view('livewire.detail')->with([
            'productosSearch' => $this->productosSearch,
            'productsOrder' => $this->productsOrder
        ]);
    }
}
