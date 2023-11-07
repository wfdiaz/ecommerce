<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 ">
        <h1 class="text-lg font-semibold mb-6"> Carro de compras </h1>
        @if (Cart::count())
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th> Precio </th>
                        <th> Cantidad </th>
                        <th> Total </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $item)
                        <tr>
                            <td>
                                <div class="flex">
                                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                                    <div>
                                        <p class="font-bold">{{ $item->name }}</p>

                                        @if ($item->options->color)
                                            <span class="mr-1"> Color: {{ __($item->options->color) }} </span>
                                        @endif

                                        @if ($item->options->size)
                                        <span class="mx-1"></span>
                                            <span> {{ $item->options->size }} </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="text-center">
                                <span> COP ${{ $item->price }} </span>
                                <a class="ml-6 cursor-pointer hover:text-red-600" 
                                    wire:click="delete('{{ $item->rowId }}')" wire:loading.class="text-red-600" wire:target="delete('{{ $item->rowId }}')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>

                            <td>
                                <div class="flex justify-center">
                                    @if ($item->options->size)
                                        @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))
                                        
                                    @elseif($item->options->color)
                                        @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
        
                                    @else
                                        @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                    @endif
                                </div>
                            </td>

                            <td class="text-center">
                                COP $ {{ $item->price * $item->qty }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a wire:click='destroy' class="text-sm cursor-pointer hover:underline inline-block mt-6">
                <i class="fas fa-trash"></i> Eliminar Carrito de compras
            </a>
        @else
            <div class="flex flex-col items-center">
                <x-cart/>
                <p class="text-lg mt-4 mb-4"> TU CARRO DE COMPRAS ESTÁ VACÍO </p>
                <x-button-enlace href="/" class="px-16 bg-pantone-393 hover:bg-pantone-1245 active:bg-pantone-1245 focus:border-pantone-1245 focus:ring-pantone-393">
                    Ir al Inicio
                </x-button-enlace>
            </div>
        @endif
    </section>

    @if (Cart::count())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-lg font-bold"> TOTAL: </p>
                    COP $ {{ Cart::subtotal() }}
                </div>
                <div>
                    <x-button-enlace href="/" class="px-16 bg-pantone-393 hover:bg-pantone-1245 active:bg-pantone-1245 focus:border-pantone-1245 focus:ring-pantone-393">
                        Continuar
                    </x-button-enlace>
                </div>
            </div>
        </div>
        
    @endif
</div>
