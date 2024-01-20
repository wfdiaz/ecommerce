<x-admin-layout>
    <div class="containerprop py-12">
        <section class="grid md:grid-cols-4 gap-6 text-white">

            <a href="{{ route('admin.orders.index') . "?status=RECEIVED" }}" class="bg-gray-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$recibido}}
                </p>
                <p class="uppercase text-center"> Recibido </p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>

            <a href="{{ route('admin.orders.index') . "?status=SENT" }}" class="bg-yellow-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$enviado}}
                </p>
                <p class="uppercase text-center"> Enviado </p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-truck"></i>
                </p>
            </a>

            <a href="{{ route('admin.orders.index') . "?status=DELIVERED" }}" class=" bg-green-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$entregado}}
                </p>
                <p class="uppercase text-center"> Entregado </p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>

            <a href="{{ route('admin.orders.index') . "?status=CANCELED" }}" class="bg-red-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$cancelado}}
                </p>
                <p class="uppercase text-center"> Cancelado </p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>
        </section>

        @if ($orders->count())
            
        
            <section class="bg-white shadow-lg rounded-lg px-6 md:px-12 py-8 mt-12 text-gray-700">
                <h1 class="text-2xl mb-4">Pedidos recientes</h1>

                <ul>
                    @foreach ($orders as $order)
                        <li>
                            <a href="{{route('admin.orders.show', $order)}}" class="flex items-center py-2 px-4 hover:bg-gray-100">
                                <span class="w-12 text-center">
                                    @switch($order->status)
                                        @case('PENDING')
                                            <i class="fas fa-business-time text-pink-500 opacity-50"></i>
                                            @break
                                        @case('RECEIVED')
                                            <i class="fas fa-credit-card text-gray-500 opacity-50"></i>
                                            @break
                                        @case('SENT')
                                            <i class="fas fa-truck text-yellow-500 opacity-50"></i>
                                            @break
                                        @case('DELIVERED')
                                            <i class="fas fa-check-circle text-green-500 opacity-50"></i>
                                            @break
                                        @case('CANCELED')
                                            <i class="fas fa-times-circle text-red-500 opacity-50"></i>
                                            @break
                                        @default
                                    @endswitch
                                </span>

                                <span>
                                    Orden: {{$order->id}}
                                    <br>
                                    {{$order->created_at->format('d/m/Y')}}
                                </span>


                                <div class="ml-auto">
                                    <span class="font-bold">
                                        {{ __($order->status) }}
                                    </span>

                                    <br>

                                    <span class="text-sm">
                                        $ {{number_format($order->total,2)}} 
                                    </span>
                                </div>

                                <span>
                                    <i class="fas fa-angle-right ml-6"></i>
                                </span>

                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>

        @else
        <div class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
            <span class="font-bold text-lg">
                No existe registros de ordenes
            </span>
        </div>
        @endif

    </div>
</x-admin-layout>