<div>
    
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
            $item->unit_price = $product->price;

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

        <div class="grid grid-cols-5 gap-6 containerprop py-8">
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
                                                        - {{ $item->options->size }}
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
                <div class="bg-white rounded-lg shadow-lg items-center">
                    <div class="flex justify-between items-center p-6 mb-6">
                        <img class="h-20" src="{{ asset('img/card.JPG') }}" alt="">
                        <div >
                            <p class="font-semibold text-sm"> Subtotal: {{ number_format($order->total - $order->shipping_cost, 0, ',', '.') }} COP</p>
                            <p class="font-semibold text-sm"> Envio: {{ number_format($order->shipping_cost, 0, ',', '.') }} COP</p>
                            <p class="font-semibold"> 
                                Total: {{ number_format($order->total, 0, ',', '.') }} COP
                            </p>
                            <div class="cho-container">

                            </div>
                        </div>
                    </div>
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
                    container: '.cho-container',
                    label: 'Pagar',
                }
            });
        </script>

    @endpush

</div>
