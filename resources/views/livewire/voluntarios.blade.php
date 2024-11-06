<div>


    @voluntario
    <div class="w-full">

        <div class="flex justify-end gap-5 items-center">
            <p class="font-semibold text-right">
                Bienvenido, {{\Illuminate\Support\Facades\Auth::guard('voluntario')->user()->name}}</p>
            <button wire:click="logout" class="hover:font-bold">Salir</button>
        </div>

        <div class="bg-green-600 text-white p-4 rounded-lg text-center">
            <p>A continuación, se muestran todos los pedidos realizados. En cada pedido se indica el almacén donde deben
                recogerse los productos, la dirección de entrega y los productos incluidos.</p>
            <p>Por favor, acepta los pedidos con responsabilidad.</p>
        </div>
        <div class="flex flex-col mt-4">
            <h1 class="text-4xl text-gray-700 italic">Mis pedidos en reparto</h1>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($misPedidos as $miPedido)
                    <x-card>
                        <x-title title="{{$miPedido->almacen->name}}"></x-title>
                        @if (session()->has('error_pedido_'.$miPedido->id))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                                <span class="block sm:inline">{{ session('error_pedido_'.$miPedido->id) }}</span>
                            </div>
                        @endif
                        <div class="mb-4">
                            <p class="text-gray-700 font-bold">Solicitante</p>
                            <div class="w-full flex mt-1 gap-2 flex-wrap flex-col">
                                <x-filament::badge size="lg">{{$miPedido->phone}}</x-filament::badge>
                                <x-filament::badge size="lg">{{$miPedido->address}}</x-filament::badge>
                            </div>
                        </div>
                        <div class="mb-4">
                            <p class="text-gray-700 font-bold">Productos</p>
                            <div class="w-full flex mt-1 gap-2 flex-wrap">
                                @foreach($miPedido->productos()->orderBy('name', 'asc')->get() as $producto)
                                    <x-filament::badge size="lg" color="danger">{{$producto->name}}</x-filament::badge>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <button wire:click="marcarEntregado({{$miPedido->id}})"
                                    class="cursor-pointer inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Marcar como entregado
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </button>

                            <button wire:click="quitarPedido({{$miPedido->id}})"
                                    class="cursor-pointer inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Cancelar
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </button>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <div class="flex flex-col mt-8">
                <h1 class="text-4xl text-black">Pedidos pendientes</h1>
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($pedidos as $pedido)
                        <x-card>
                            <x-title title="{{$pedido->almacen->name}}"></x-title>
                            @if (session()->has('error_pedido_'.$pedido->id))
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                                    <span class="block sm:inline">{{ session('error_pedido_'.$pedido->id) }}</span>
                                </div>
                            @endif
                            <div class="mb-4">
                                <p class="text-gray-700 font-bold">Solicitante</p>
                                <div class="w-full flex mt-1 gap-2 flex-wrap flex-col">
                                    <x-filament::badge size="lg">{{$pedido->phone}}</x-filament::badge>
                                    <x-filament::badge size="lg">{{$pedido->address}}</x-filament::badge>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p class="text-gray-700 font-bold">Productos</p>
                                <div class="w-full flex mt-1 gap-2 flex-wrap">
                                    @foreach($pedido->productos()->orderBy('name', 'asc')->get() as $producto)
                                        <x-filament::badge size="lg"
                                                           color="danger">{{$producto->name}}</x-filament::badge>
                                    @endforeach
                                </div>
                            </div>
                            <button wire:click="aceptOrder({{$pedido->id}})"
                                    class="cursor-pointer inline-flex  items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Aceptar pedido
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="ml-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 5l0 14"/>
                                    <path d="M5 12l14 0"/>
                                </svg>
                            </button>
                        </x-card>
                    @endforeach
                </div>
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
