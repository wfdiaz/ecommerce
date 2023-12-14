<div x-data="{opencart : false}"  x-on:mouseleave="opencart = false">
    <span class="relative inline-block cursor-pointer"  x-on:mouseover="opencart = true">
        <a href="{{ route('cart') }}">
            <x-cart color="black" size='25'/>
        </a>

        @if (Cart::count())
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-pantone-1255 rounded-full">{{ Cart::count() }}</span>
        @endif
    </span>

    {{-- <x-jet-dropdown width="96">
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">
                <x-cart color="black" size='25'/>
                @if (Cart::count())
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-pantone-1255 rounded-full">{{ Cart::count() }}</span>
                @endif
            </span>
        </x-slot>

        <x-slot name="content">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-black">
                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                        <article class="flex-1">
                            <h1 class="font-bold"> {{ $item->name }}</h1>
                            <div class="flex">
                                <p> Cantidad: {{ $item->qty }}</p>
                                @isset($item->options['color'])
                                    <p class="ml-2"> - Color:&nbsp;
                                        <p class="capitalize mr-2"> {{ __($item->options['color']) }} </p>
                                    </p>
                                @endisset

                                @isset($item->options['size'])
                                    <p> {{ $item->options['size'] }} </p>
                                @endisset
                            </div>

                            <p> COP $ {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center">
                            No tiene agregado ningun item en el carrito
                        </p>
                    </li>
                @endforelse
            </ul>

            @if (Cart::count())
                <div class="px-2 py-3">
                    <p class="text-lg mt-2 mb-3"> <span class="font-bold"> Total : </span> COP $ {{ Cart::subtotal() }} </p>
                    <x-button-enlace href="{{ route('cart') }}" class="w-full bg-pantone-393 hover:bg-pantone-1245 active:bg-pantone-1245 focus:border-pantone-1245 focus:ring-pantone-393">
                        Ir al carrito de compras
                    </x-button-enlace>
                </div>
            @endif
        </x-slot>
    </x-jet-dropdown> --}}
    <div x-show='opencart' class="absolute bg-white w-72 end-0 top-20">
        <ul>
            @forelse (Cart::content() as $item)
                <li class="flex p-2 border-b border-black">
                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                    <article class="flex-1">
                        <h1 class="font-bold"> {{ $item->name }}</h1>
                        <div class="flex">
                            <p> Cantidad: {{ $item->qty }}</p>
                            @isset($item->options['color'])
                                <p class="ml-2"> - Color:&nbsp;
                                    <p class="capitalize mr-2"> {{ __($item->options['color']) }} </p>
                                </p>
                            @endisset

                            @isset($item->options['size'])
                                <p> {{ $item->options['size'] }} </p>
                            @endisset
                        </div>

                        <p> COP $ {{ $item->price }}</p>
                    </article>
                </li>
            @empty
                <li class="py-3 px-4">
                    <p class="text-center text-xl font-bold">
                        Tu carrito está vacio
                    </p>
                </li>
            @endforelse
        </ul>
    </div>
</div>
