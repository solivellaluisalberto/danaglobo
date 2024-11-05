<div class="w-full">

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($productos as $producto)
            <x-card>
                <x-title :title="$producto->name"></x-title>
                <button wire:click="addToOrder({{$producto}})" class="cursor-pointer inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Añadir
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </button>
            </x-card>
        @endforeach
    </div>

    <div class="mt-6" id="cart-section">
        @foreach($productsOrder as $productOrder)
            <p>{{$productOrder['name']}}</p>
        @endforeach
    </div>

   @if(count($productsOrder) > -1)
        <button class="fixed bottom-5 right-5 bg-amber-600 rounded-full p-4 text-white">
            <svg  xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="w-12"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
        </button>
   @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.livewire.on('scroll-to-cart', () => {
                document.getElementById('cart-section').scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>

</div>
