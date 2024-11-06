<div>


    @voluntario
        <div class="w-full">

            <div class="flex justify-end gap-5 items-center">
                <p class="font-semibold text-right">Bienvenido, {{\Illuminate\Support\Facades\Auth::guard('voluntario')->user()->name}}</p>
                <button wire:click="logout" class="hover:font-bold">Salir</button>
            </div>

            <div class="bg-green-600 text-white p-4 rounded-lg text-center">
                <p>A continuación, se muestran todos los pedidos realizados. En cada pedido se indica el almacén donde deben recogerse los productos, la dirección de entrega y los productos incluidos.</p>
                <p>Por favor, acepta los pedidos con responsabilidad.</p>
            </div>
        </div>
    @else

        <h1 class="font-bold text-2xl text-black text-center">VOLUNTARIOS</h1>
        <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

                <form wire:submit.prevent="login" class="space-y-6 mb-4">
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

        </div>

        <p class="font-bold text-black text-center w-full mt-4 mb-4">O Regístrate</p>

        <div class="max-w-md mx-auto p-6 bg-white shadow-md rounded-lg">
            @if (session()->has('error_register'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                    <span class="block sm:inline">{{ session('error_register') }}</span>
                </div>
            @endif

                <form wire:submit.prevent="register" class="space-y-6">
                    <div>
                        <label for="phone" class="block text-gray-700 font-medium">Nombre</label>
                        <input
                            type="text"
                            id="name"
                            wire:model="name"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        >
                    </div>

                    <div>
                        <label for="phoner" class="block text-gray-700 font-medium">Teléfono</label>
                        <input
                            type="number"
                            id="phoner"
                            wire:model="phoner"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Registrarse
                    </button>
                </form>

        </div>




        @endvoluntario

</div>
