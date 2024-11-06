<div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @voluntario
    <p class="text-green-700 font-semibold mb-4">Bienvenido, Voluntario</p>
    @else
        <p class="text-gray-700 font-semibold mb-4">Por favor, inicia sesión como Voluntario.</p>

            <form wire:submit.prevent="login" class="space-y-6">
                <div>
                    <label for="phone" class="block text-gray-700 font-medium">Teléfono</label>
                    <input
                        type="number"
                        id="phone"
                        wire:model="phone"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Iniciar sesión
                </button>
            </form>
        @endvoluntario
</div>
