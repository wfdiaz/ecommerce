<div class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">
        <div class="bg-white rounded-lg shadow p-4">
            <div>
                <x-jet-label value='Nombre de contacto'/>
                <x-jet-input wire:model.defer="contact" class="w-full" type="text" placeholder="Ingrese el nombre de a persona que recibirá el producto"/>
                <x-jet-input-error for="contact"/>
            </div>

            <div>
                <x-jet-label value='Teléfono de contacto'/>
                <x-jet-input wire:model.defer="phone" class="w-full" type="text" placeholder="Ingrese un número de teléfono de contacto"/>
                <x-jet-input-error for="phone"/>
            </div>
        </div>

        <div x-data="{envio_type: @entangle('envio_type')}">
            <p class="mt-6 mb-3 text-lg font-semibold"> Envíos </p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center cursor-pointer mb-4">
                <input x-model="envio_type" type='radio' name='envio_type' value="1">
                <span class="ml-2 "> Recoger en tienda </span>
                <span class="font-semibold ml-auto"></span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center cursor-pointer">
                    <input x-model="envio_type" type='radio' name='envio_type' value="2">
                    <span class="ml-2"> Envió a domicilio </span>
                </label>

                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{'hidden': envio_type != 2}">
                    {{-- Departaments --}}
                    <div>
                        <x-jet-label value="Departamento"/>
                        <select class="form-control w-full" wire:model='departament_id'>
                            <option value="" disabled selected> Seleccione un Departamento </option>
                            @foreach ($departaments as $departament)
                                <option value="{{ $departament->id }}"> {{ $departament->name }} </option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="departament_id"/>
                    </div>

                    {{-- Cities --}}
                    <div>
                        <x-jet-label value="Ciudad / Municipio"/>
                        <select class="form-control w-full" wire:model='city_id'>
                            <option value="" disabled selected> Seleccione una Ciudad </option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"> {{ $city->name }} </option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="city_id"/>
                    </div>

                    <div class="col-span-2">
                        <x-jet-label value="Dirección"/>
                        <x-jet-input wire:model='address' class="w-full" type='text'/>
                        <x-jet-input-error for="address"/>
                    </div>

                    <div class="col-span-2">
                        <x-jet-label value="Referencia"/>
                        <x-jet-input wire:model='reference' class="w-full" type='text'/>
                        <x-jet-input-error for="reference"/>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <x-jet-button class="mt-6 mb-4" wire:click="createOrder" wire:loading.attr='disabled' wire:target='createOrder'> Continuar con la compra </x-jet-button>
            <hr>
            <p class="text-sm mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis libero doloremque atque eos dolore ex totam iusto enim temporibus dolor, quod voluptatem incidunt beatae dicta animi rerum? Nihil, libero culpa. <a class="font-semibold text-pantone-1245 "> Politicas y privacidad.</a></p>
        </div>
    </div>

    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow px-6 py-4">
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

            <hr class="mb-3 mt-4">

            <div>
                <p class="flex justify-between items-center"> Subtotal <span class="font-semibold"> {{ number_format(str_replace(',','',Cart::subtotal()), 0, ',', '.' ) }} COP </span> </p>

                <p class="flex justify-between items-center"> Envio <span class="font-semibold"> 
                @if ($envio_type == 1 || 0 == $shipping_cost)
                    Gratis
                @else
                    {{ $shipping_cost }} COP
                @endif    
                </span> </p>

                <hr class="mb-3 mt-4">

                <p class="flex justify-between items-center font-semibold">  <span class="text-lg"> TOTAL </span> {{  number_format(floatval(str_replace(',','',Cart::subtotal())) + $this->shipping_cost, 0, ',', '.' ) }} COP </p>
            </div>
        </div>
    </div>
</div>
