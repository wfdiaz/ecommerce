<div x-data>
    
    @php
        //SDK de Mercado pago
        require base_path('vendor/autoload.php');
        //Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        //crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        $shipments = new MercadoPago\Shipments();

        $shipments->cost = $order->shipping_cost;
        $shipments->mode = "not_specified";

        $preference->shipments = $shipments;
        //crea un item en la preferencia
        // $item = new MercadoPago\Item();
        // $item->title = 'Mi Producto';
        // $item->quantity = 1;
        // $item->unit_price = 75.56;
        foreach ($items as $product) {
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->price - $product->discount;

            $products[] = $item;
        }

        $preference->back_urls = array(
            'success' => route('orders.pay', $order),
            'failure' => "https://www.tu-sitio/failure",
            'pending' => "https://www.tu-sitio/pending"
        );
        
        $preference->auto_return = "approved"; 
        // $preference->items = array($item);
        $preference->items = $products;
        $preference->save();
    @endphp

        <div class="hidden md:grid grid-cols-5 gap-6 containerprop py-8">
            <div class="col-span-3">
                <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                    <p class="uppercase"> <span class="font-semibold"> Número de orden: </span> Orden-{{ $order->id }} </p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-lg font-semibold uppercase"> Envío </p>
                            @if ($order->envio_type == 1)
                                <p class="text-sm"> Los productos deben ser recogidos en tienda </p>
                                <p class="text-sm"> calle</p>
                            @else
                                <p class="text-sm"> Los productos serán enviados a: </p>
                                <p class="text-sm"> {{ $envio->address }}</p>
                                <p> {{ $envio->department }} - {{ $envio->city }}</p>
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
                                <th> Descuento </th>
                                <th> Total </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <div class="flex">
                                            <img class="h-10 md:h-15 w-15 md:w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                                            <article>
                                                <h1 class="font-bold">{{ $item->name }}</h1>
                                                <div class="flex text-sx">
                                                    @isset ($item->options->color)
                                                        Color {{ __($item->options->color) }}
                                                    @endisset

                                                    @isset ($item->options->size)
                                                        - {{ $item->options->size }}
                                                    @endisset
                                                </div>
                                            </article>
                                        </div>
                                    </td>
                                    <td class="text-center"> {{ number_format($item->price, 0, ',', '.') }} COP</td>
                                    <td class="text-center"> {{ $item->qty }} </td>
                                    <td class="text-center"> {{ number_format($item->discount, 0, ',', '.') }} </td>
                                    <td class="text-center"> {{ number_format(($item->price * $item->qty) - $item->discount, 0, ',', '.') }} COP</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-span-2">
                <div class="bg-white rounded-lg shadow-lg items-center">
                    <div class="mb-6 px-6">
                        <div class="flex items-center">
                            <div class="mr-auto">
                                <p class="font-semibold text-sm"> Subtotal: {{ number_format($order->total - $order->shipping_cost - $order->discount, 0, ',', '.') }} COP</p>
                                <p class="font-semibold text-sm"> Descuento: {{ number_format($order->discount, 0, ',', '.') }} COP</p>
                                    <p class="font-semibold text-sm"> Envio: {{ number_format($order->shipping_cost, 0, ',', '.') }} COP</p>
                                <p class="font-semibold"> 
                                    Total: {{ number_format($order->total, 0, ',', '.') }} COP
                                </p>
                            </div>
                            <div class="ml-auto cho-container-desktop">

                            </div>
                        </div>
                        <img class="h-20" src="{{ asset('img/card.JPG') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="containerprop md:hidden">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="uppercase"> <span class="font-semibold"> Número de orden: </span> Orden-{{ $order->id }} </p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <p class="text-xl font-semibold mb-4"> Resumen </p>
                @foreach ($items as $item)
                    <div>
                        <div class="flex">
                            <img class="h-10 md:h-15 w-15 md:w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                            <article class="w-full">
                                <h1 class="font-bold">{{ $item->name }}</h1>
                                <div class="flex text-xs">
                                    @isset ($item->options->color)
                                        Color {{ __($item->options->color) }}
                                    @endisset

                                    @isset ($item->options->size)
                                        - {{ $item->options->size }}
                                    @endisset
                                </div>
                                <div class="flex justify-between mt-2">
                                <p class="text-center mr-auto"> Cantidad: {{ $item->qty }} </p>
                               
                                <div class="ml-auto">
                                    <p class="text-center" :class="{'line-through text-red-500': '{{ $item->discount }}' != '0'}">
                                        $ {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                    </p>
                                    @if ($item->discount)
                                        <p class="text-center">
                                            $ {{ number_format(($item->price * $item->qty) - $item->discount , 0, ',', '.') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            </article>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-white rounded-lg shadow-lg items-center mb-6">
                <div class="pb-0 pl-4 pr-4 pt-4">
                    <div class="flex justify-center items-center mb-2">
                        <div class="mr-auto">
                            <p class="font-semibold text-sm"> Subtotal: {{ number_format($order->total - $order->shipping_cost - $order->discount, 0, ',', '.') }} COP</p>
                            <p class="font-semibold text-sm"> Descuento: {{ number_format($order->discount, 0, ',', '.') }} COP</p>
                            <p class="font-semibold text-sm"> Envio: {{ number_format($order->shipping_cost, 0, ',', '.') }} COP</p>
                            <p class="font-semibold"> 
                                Total: {{ number_format($order->total, 0, ',', '.') }} COP
                            </p>
                        </div>
                        
                        <div class="ml-auto cho-container-movil">

                        </div>
                    </div>
                    <img class="h-20" src="{{ asset('img/card.JPG') }}" alt="">
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div>
                    <p class="text-lg font-semibold uppercase"> Envío </p>
                    @if ($order->envio_type == 1)
                        <p class="text-sm"> Los productos deben ser recogidos en tienda </p>
                        <p class="text-sm"> calle</p>
                    @else
                        <p class="text-sm"> Los productos serán enviados a: </p>
                        <p class="text-sm"> {{ $envio->address }}</p>
                        <p> {{ $envio->department }} - {{ $envio->city }}</p>
                    @endif
                </div>
                <div>
                    <p class="text-lg font-semibold uppercase"> Datos de contacto </p>
                    <p class="text-sm"> Persona que recibirá el producto: {{ $order->contact }} </p>
                    <p class="text-sm"> Telefono de contacto: {{ $order->phone }}</p>
                </div>
            </div>
        </div>

    @push('script')
        
   
        <script src="https://sdk.mercadopago.com/js/v2"></script>

        <script>
            //Agrega credenciales de SDK
            const mp = new MercadoPago("{{ config('services.mercadopago.key') }}",{
                locate: 'es-AR'
            });

            // Inicializa el checkout
            mp.checkout({
                preference:{
                    id: '{{ $preference->id }}'
                },
                render: {
                    container: '.cho-container-desktop',
                    label: 'Pagar',
                }
            });

            mp.checkout({
                preference:{
                    id: '{{ $preference->id }}'
                },
                render: {
                    container: '.cho-container-movil',
                    label: 'Pagar',
                }
            });
        </script>

    @endpush

</div>
