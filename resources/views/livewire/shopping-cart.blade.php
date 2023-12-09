<div class="containerprop py-8">
    <x-table-responsive>
        <div class="px-6 py-4 bg-white">
            <h1 class="text-lg font-semibold text-gray-700">CARRO DE COMPRAS</h1>
        </div>
        @if (Cart::count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Precio
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cantidad
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach (Cart::content() as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover object-center" src="{{ $item->options->image }}" alt="">
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"> {{$item->name}} </div>
                                        <div class="text-sm text-gray-500">
                                            @if ($item->options->color)
                                                <span>
                                                    Color: {{ __($item->options->color) }}
                                                </span>    
                                            @endif

                                            @if ($item->options->size)
                                                <span class="mx-1">-</span>
                                                <span> {{ $item->options->size }} </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                         
                                <div class="text-sm text-gray-500">
                                    <span>COP $ {{ $item->price }}</span>
                                    <a class="ml-6 cursor-pointer hover:text-red-600" wire:click="delete('{{$item->rowId}}')" wire:loading.class="text-red-600 opacity-25" wire:target="delete('{{$item->rowId}}')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    @if ($item->options->size)

                                        @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))

                                    @elseif($item->options->color)

                                        @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
                                        
                                    @else

                                        @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))

                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="text-sm text-gray-500">
                                    COP $ {{$item->price * $item->qty}}
                                </div>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

            <div class="px-6 py-4">
                <a class="text-sm cursor-pointer hover:underline mt-3 inline-block" 
                    wire:click="destroy">
                    <i class="fas fa-trash"></i>
                    Borrar carrito de compras
                </a>
            </div>

        @else
            <div class="flex flex-col items-center">
                <x-cart />
                <p class="text-lg text-gray-700 mt-4">TU CARRO DE COMPRAS ESTÁ VACÍO</p>

                <x-button-enlace href="/" class="mt-4 px-16 bg-pantone-393 hover:bg-pantone-1245 active:bg-pantone-1245 focus:border-pantone-1245 focus:ring-pantone-393">
                    Ir al inicio
                </x-button-enlace>
            </div>
        @endif

    </x-table-responsive>


    @if (Cart::count())

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">Total:</span>
                        COP $ {{ Cart::subTotal() }}
                    </p>
                </div>

                <div>
                    <x-button-enlace href="{{ route('orders.create') }}" class="px-16 bg-pantone-393 hover:bg-pantone-1245 active:bg-pantone-1245 focus:border-pantone-1245 focus:ring-pantone-393">
                        Continuar
                    </x-button-enlace>
                </div>
            </div>
        </div>
    @endif
</div>