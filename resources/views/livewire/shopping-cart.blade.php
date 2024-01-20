<div class="containerlittle py-8" x-data>
    @if (Cart::count())
        <div class="grid md:grid-cols-3 gap-6 items-center">
            <div class="md:col-span-2">
                <h1 class="text-2xl font-black"> TU CARRITO </h1>
                <p class="text-sm my-3"> TOTAL ({{ Cart::count() }} productos) <a class="font-bold"> ${{ number_format(Cart::subtotalFloat(),2, ',', '.') }} </a></p>
                <p class="mb-10"> Los artículos en tu carrito no están apartados. Termina el proceso de compra ahora para quedartelos. </p>

                @foreach (Cart::content() as $item)
                    <div class="mb-6 border border-black relative">
                        <article class="flex">
                            <figure>
                                <img class="h-24 w-24 object-cover object-center" src="{{ $item->options->image }}" alt='image' style="aspect-ratio: 1/1;"   >
                            </figure>

                            <div class="ml-4 flex-auto pt-4">
                                <div class="text-md text-gray-900"> {{Str::limit($item->name, 25) }} </div>
                                <div class="text-xs">
                                    @if ($item->options->color)
                                        <span> Color: {{ __($item->options->color) }}   </span>
                                    @endif
                                </div>
                                @if ($item->options->size)
                                    <div class="text-xs mt-2">
                                        <span> Talla: {{ $item->options->size }} </span>
                                    </div>
                                @endif
                                <div class="flex items-center">
                                    <div class="mr-auto">
                                        @if ($item->options->size)
                                            @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))
                                        @elseif($item->options->color)
                                            @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
                                        @else
                                            @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                        @endif
                                    </div>
                                    <div class="ml-auto mr-2 flex flex-wrap">
                                        <div class="ml-4 md:ml-0 text-md font-semibold" :class="{'line-through text-red-500': '{{ $item->subtotal()}}' != '{{ $item->priceTotal() }}'}">
                                            ${{number_format($item->price * $item->qty, 2, ',', '.')}}
                                        </div>

                                        @if ($item->subtotal() != $item->priceTotal())
                                            <div class="ml-4 text-md font-semibold">
                                                ${{ $item->subtotal() }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </article>
                        <a class="absolute top-2 right-2 cursor-pointer" wire:click="delete('{{$item->rowId}}')" wire:loading.class="text-red-600 opacity-25" wire:target="delete('{{$item->rowId}}')">
                            <x-close/>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center">
                <div>
                    <p class="text-left">
                        <span class="font-bold text-lg">Subtotal:</span>
                        ${{ number_format(Cart::priceTotalFloat(),2, ',', '.') }}
                    </p>

                    <p class="text-left">
                        <span class="font-bold text-lg">Descuento:</span>
                        ${{ number_format(Cart::discountFloat(),2, ',', '.') }}
                    </p>

                    <p class="text-left pb-8">
                        <span class="font-bold text-lg">Total:</span>
                        ${{ number_format(Cart::subtotalFloat(),2, ',', '.') }}
                    </p>
                    <a class="group relative inline-flex border border-pantone-1245 focus:outline-none lg:inline-flex " href="{{ route('orders.create') }}">
                        <span class="w-full inline-flex items-center justify-center self-stretch px-4 py-2 text-sm text-pantone-1245 text-center font-bold uppercase bg-white ring-1 ring-pantone-1245 ring-offset-1 transform transition-transform 
                        -translate-y-1 -translate-x-1 group-hover:translate-y-0 group-hover:translate-x-0 group-focus:translate-y-0 group-focus:translate-x-0">
                            Continuar con la compra
                        </span>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="h-96">
            <h1 class="text-2xl font-black"> EL CARRITO ESTÁ VACÍO </h1>
            <p class="py-4"> Cuando añadas un producto al carrito, aquí lo verás. </p>
            <a class="group relative inline-flex border border-pantone-1245 focus:outline-none lg:inline-flex" href="/">
                <span class="w-full inline-flex items-center justify-center self-stretch px-4 py-2 text-sm text-pantone-1245 text-center font-bold uppercase bg-white ring-1 ring-pantone-1245 ring-offset-1 transform transition-transform 
                -translate-y-1 -translate-x-1
                group-hover:translate-y-0 group-hover:translate-x-0 group-focus:translate-y-0 group-focus:translate-x-0">
                    !! Vamos ¡¡ 
                </span>
            </a>
        </div>
    @endif
</div>