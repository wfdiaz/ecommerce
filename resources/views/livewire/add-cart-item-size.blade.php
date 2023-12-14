<div x-data>
    <div class="-mt-10 md:my-6">
        <p class="text-xl mb-2"> Tallas disponibles: </p>
        <div class="grid grid-cols-3 md:grid-cols-4 gap-0.5 md:gap-1">
            @foreach ($sizes as $sz)
                <div class="cursor-pointer text-center px-3 py-3 border border-pantone-1255 text-black hover:bg-pantone-1245 hover:text-white" wire:click="$set('size_id',{{ $sz->id }})" :class="{'bg-pantone-1245 text-white': $wire.size_id == '{{ $sz->id }}' }">{{ $sz->name }} </div>
            @endforeach
        </div>
    </div>

    @if ($this->size_id != '')
        <div class="mt-6 md:mt-0">
            <p class="text-xl mb-2"> Colores disponibles: </p>

            <div class="grid grid-cols-3 md:grid-cols-4 gap-0.5 md:gap-1">
                @foreach ($colors as $color)
                    <div class="cursor-pointer text-center px-3 py-3 border border-pantone-1255 text-black hover:bg-pantone-1245 hover:text-white capitalize" wire:click="$set('color_id',{{ $color->id }})" :class="{'bg-pantone-1245 text-white': $wire.color_id == '{{ $color->id }}' }"> {{ __($color->name) }} </div>
                @endforeach
            </div>

            @if($this->color_id != '')
                <p class="my-4"> 
                    <span class="font-semibold text-lg"> Stock disponible :</span> {{ $quantity }}
                </p>

                <div class="flex items-center mt-4">
                    <div class="mr-4">
                        <x-jet-secondary-button disabled x-bind:disabled="$wire.qty <= 1" wire:loading.attr="disabled" wire:target='decrement' wire:click='decrement'> - </x-jet-secondary-button>
                        <span class="mx-2">{{ $qty }}</span>
                        <x-jet-secondary-button x-bind:disabled="$wire.qty >= $wire.quantity" wire:loading.attr="disabled" wire:target='increment' wire:click='increment'> + </x-jet-secondary-button>
                    </div>
                    <div class="flex-1">
                        <x-button disabled x-bind:disabled="!$wire.quantity" class="w-full bg-pantone-393 hover:bg-pantone-1245 active:bg-pantone-1245 focus:border-pantone-1245 focus:ring-pantone-393"
                        x-bind:disabled="$wire.qty > $wire.quantity" wire:click='addItem' wire:loading.attr="disabled" wire:target='addItem'> Agregar al carrito de compras </x-button>
                    </div>
                </div>
            @else
                <div class="block h-10">
                </div>
            @endif
        </div>
    @else
        <div class="block h-10">
        </div>
    @endif
</div>
