<div class="w-full">

    @if($orderCompleted)

    @else

    @endif

    <div class="mb-4 flex gap-4">
        <button wire:click="redirectClick()" class="cursor-pointer inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <svg class="rotate-180 w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
            Volver
        </button>
        <x-title  big="true" title="{{$almacen->name}}"></x-title>
    </div>

        <input wire:model.debounce.300ms.live="searchTerm" type="text"  class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Agua...">


        @if(!$orderCompleted)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($productosSearch as $producto)
            <x-card>
                <x-title :title="$producto->name"></x-title>

                @if (!in_array($producto->id, array_map(fn($orderItem) => $orderItem['product']['id'], $this->productsOrder)))
                <button wire:click="addToOrder({{$producto}})" class="cursor-pointer inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Añadir
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </button>
                @endif
            </x-card>
        @endforeach
    </div>
        @endif

        @if($orderCompleted)
            <div class="w-full bg-green-600 text-white p-2 rounded-lg">
                <p>Pedido realizado correctamente</p>
            </div>
            <button wire:click="resetForm" class=" mt-2 bg-blue-500 rounded-lg p-2 text-white">REALIZAR OTRO</button>
        @endif

        @if($errorMessage)
            <div class="w-full bg-red-600 text-white p-2 rounded-lg mt-4">
                <p>{{$errorMessage}}</p>
            </div>
        @endif

   @if(count($productsOrder) > 0)
        <div class="mt-6 mb-6" id="cart-section">
            <x-title title="PEDIDO"></x-title>
                @foreach($productsOrder as $index => $productOrder)
                    <div class="flex gap-2 items-center">
                        <p class="text-gray-700">{{$productOrder['product']['name']}}</p>
                        <div class="rounded bg-gray-50 border border-gray-300 p-2 text-sm font-medium text-black w-fit">
                            <label for="quantity_product_{{$productOrder['product']['id']}}">Cantidad:</label>
                            <select id="quantity_product_{{$productOrder['product']['id']}}" class="p-2 focus:outline-none" wire:change="updateQuantity({{ $productOrder['product']['id'] }}, $event.target.value)">
                                <option selected value="1">1</option>
                                @for($i = 2; $i < 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button wire:click="removeProduct({{$index}})">
                            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="currentColor"  class="w-4 text-red-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16zm-9.489 5.14a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" /><path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" /></svg>
                        </button>
                    </div>
                @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="w-full">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Número de teléfono</label>
                <input wire:model="form.phone" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="873634344">
            </div>

            <div class="w-full">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Dirección</label>
                <input wire:model="form.address" type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Crtra. prueba, 32">
            </div>

            <div class="w-full">
                <label for="observaciones" class="block mb-2 text-sm font-medium text-gray-900">Observaciones</label>
                <input type="text" id="observaciones" wire.model="observaciones"></input>
            </div>
        </div>

        <button wire:click="submitForm" class="bg-green-600 text-white rounded-md p-2 font-bold text-2xl mt-2">PEDIR</button>

        <a href="#cart-section" class="fixed bottom-5 right-5 bg-amber-600 rounded-full p-4 text-white">
            <svg  xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="w-12"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
        </a>
   @endif
</div>
