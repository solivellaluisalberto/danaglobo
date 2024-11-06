<?php

namespace App\Livewire;

use App\Models\Pedido;
use App\Models\Voluntario;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Voluntarios extends Component
{
    public $phone;
    public $phoner;
    public $name;

    public $hora_estimada_recogida = [];
    public function login()
    {
        // Validar los datos ingresados
        $this->validate([
            'phone' => 'required|numeric',
        ]);

        // Buscar al usuario por el teléfono
        $user = Voluntario::where('phone', $this->phone)->first();

        if ($user) {
            // Iniciar sesión manualmente
            Auth::guard('voluntario')->login($user);
            session()->regenerate();
            return redirect()->intended('/voluntarios'); // Redirigir al área de voluntarios
        }

        // Mostrar mensaje de error si falla la autenticación
        session()->flash('error', 'Credenciales inválidas.');
    }

    public function register()
    {
        $this->validate([
            'phoner' => 'required|numeric',
            'name' => 'required|string'
        ]);

        $user = Voluntario::where('phone', $this->phoner)->first();

        if ($user) {
            session()->flash('error_register', 'Ya existe un usuario con este teléfono.');
            // Iniciar sesión manualmente
        } else {
            $user = Voluntario::create([
                'phone' => $this->phoner,
                'name' => $this->name,
            ]);
            // Iniciar sesión manualmente
            Auth::guard('voluntario')->login($user);
            session()->regenerate();
            return redirect()->intended('/voluntarios');
        }

        // Mostrar mensaje de error si falla la autenticación
        session()->flash('error_register', 'Introduce todos los datos.');
    }

    public function aceptOrder($pedidoId)
    {

        $validatedData = $this->validate([
            "hora_estimada_recogida.$pedidoId" => 'required|string',
        ]);

        $pedido = Pedido::find($pedidoId);

        if ($pedido->voluntario_id === null) {
            $pedido->voluntario_id = Auth::guard('voluntario')->user()->id;
            $pedido->hora_estimada_recogida = $this->hora_estimada_recogida[$pedidoId];
            $pedido->save();
        } else {
            session()->flash('error_pedido_'.$pedidoId, 'Este pedido ya ha sido aceptado por alguien.');
        }

    }

    public function quitarPedido($pedidoId){
        $pedido = Pedido::find($pedidoId);
        if ($pedido->voluntario_id == Auth::guard('voluntario')->user()->id) {
            $pedido->voluntario_id = null;
            $pedido->save();
        } else {
            session()->flash('error_pedido_'.$pedidoId, 'Este pedido no es tuyo.');
        }
    }

    public function marcarEntregado($pedidoId)
    {
        $pedido = Pedido::find($pedidoId);
        if ($pedido->voluntario_id == Auth::guard('voluntario')->user()->id) {
            $pedido->entregado = 1;
            $pedido->save();
        } else {
            session()->flash('error_pedido_'.$pedidoId, 'Este pedido no es tuyo.');
        }
    }

    public function logout()
    {
        Auth::guard('voluntario')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/voluntarios');
    }
    public function render()
    {
        return view('livewire.voluntarios')->with([
            'pedidos' => Pedido::where('voluntario_id',null)->where('entregado',false)->get(),
            'misPedidos' => Auth::guard('voluntario')->user() ? Auth::guard('voluntario')->user()->pedidos()->where('entregado',false)->get() : null,
        ]);
    }
}
