<?php

namespace App\Livewire;

use App\Models\Voluntario;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Voluntarios extends Component
{
    public $phone;

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
    public function render()
    {
        return view('livewire.voluntarios');
    }
}
