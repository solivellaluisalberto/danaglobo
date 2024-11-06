<div>
    <header class="py-4">
        <p>Esta aplicación ha sido creada para facilitar el acceso a productos básicos donados para los afectados por la reciente inundación en Valencia.</p>
        <p>Aquí podrás:</p>
        <ul>
            <li class="font-semibold"> - Ver los productos disponibles en los distintos almacenes de ayuda.</li>
            <li class="font-semibold"> - Solicitar los artículos esenciales que necesites para ti y tu familia.</li>
            <li class="font-semibold"> - Ver los pueblos y áreas donde cada almacén puede realizar entregas.</li>
        </ul>
    </header>

    <div class="bg-green-600 text-white p-4 rounded-lg text-center">
        <p>Para que los voluntarios accedáis al panel y podáis aceptar los pedidos de los afectados, pulsad el siguiente botón.</p>
        <p>Información importante: antes de aceptar un pedido, aseguraos de que este pertenece al almacén más cercano o al que tengáis accesible.</p>
        <a href="/voluntarios" class="p-2 bg-white rounded-md text-green-600 hover:bg-green-700 hover:text-white mt-4">PANEL VOLUNTARIOS</a>
    </div>

    <main class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($almacenes as $almacen)
            <x-card>
                <x-title :title="$almacen->name"></x-title>
                <div class="mb-4">
                    <p class="text-gray-700 font-bold">Sitios</p>
                    <div class="w-full flex mt-1 gap-2 flex-wrap">
                        @foreach($almacen->sitios()->orderBy('name', 'asc')->get() as $sitio)
                            <x-filament::badge  size="lg">{{$sitio->name}}</x-filament::badge>
                        @endforeach
                    </div>
                </div>
                <div class="mb-4">
                    <p class="text-gray-700 font-bold">Productos</p>
                    <div class="w-full flex mt-1 gap-2 flex-wrap">
                        @foreach($almacen->productos()->orderBy('name', 'asc')->get() as $producto)
                            <x-filament::badge size="lg" color="danger">{{$producto->name}}</x-filament::badge>
                        @endforeach
                    </div>
                </div>
                <button wire:click="redirectClick({{$almacen->id}})" class="cursor-pointer inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Pedir
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </button>
            </x-card>
        @endforeach
    </main>

</div>
