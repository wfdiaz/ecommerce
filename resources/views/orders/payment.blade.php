<x-app-layout>

        <div class="grid grid-cols-5 gap-6 container py-8">
            <div class="col-span-3">
                <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                    <p class="uppercase"> <span class="font-semibold"> Número de orden: </span> Orden-{{ $order->id }} </p>
                </div>
        
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-lg font-semibold uppercase"> Envío </p>
                            @if ($order->envio_type == 1)
                                <p class="text-sm"> Los productos deben ser recogidos en tienda </p>
                                <p class="text-sm"> calle</p>
                            @else
                                <p class="text-sm"> Los productos serán enviados a: </p>
                                <p class="text-sm"> {{ $order->address }}</p>
                                <p> {{ $order->departament->name }} - {{ $order->city->name }}</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-lg font-semibold uppercase"> Datos de contacto </p>
                            <p class="text-sm"> Persona que recibirá el producto: {{ $order->contact }} </p>
                            <p class="text-sm"> Telefono de contacto: {{ $order->phone }}</p>
                        </div>
                    </div>
                </div>
        
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <p class="text-xl font-semibold mb-4"> Resumen </p>
        
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th></th>
                                <th> Precio </th>
                                <th> Cantidad </th>
                                <th> Total </th>
                            </tr>
                        </thead>
        
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <div class="flex">
                                            <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                                            <article>
                                                <h1 class="font-bold">{{ $item->name }}</h1>
                                                <div class="flex text-sx">
        
                                                    @isset ($item->options->color)
                                                       Color {{ __($item->options->color) }}
                                                    @endisset
                                                    
                                                    @isset ($item->options->size)
                                                       -  {{ $item->options->size }}
                                                    @endisset
                                                </div>
        
                                            </article>
                                        </div>
                                    </td>
        
                                    <td class="text-center"> {{ number_format($item->price, 0, ',', '.') }} COP</td>
                                    <td class="text-center"> {{ $item->qty }} </td>
                                    <td class="text-center"> {{ number_format($item->price * $item->qty, 0, ',', '.') }} COP</td>
        
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-span-2">
                <div class="bg-white rounded-lg shadow-lg">
                    <div class="flex justify-between items-center p-6">
                        <img src="" alt="">
                        <div>
                            <p class="font-semibold text-sm"> Subtotal: {{  number_format($order->total - $order->shipping_cost, 0, ',', '.') }} COP</p>
                            <p class="font-semibold text-sm"> Envio: {{ number_format($order->shipping_cost, 0, ',', '.') }} COP</p>
                            <p class="font-semibold"> Total: {{ number_format($order->total, 0, ',', '.') }} COP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>