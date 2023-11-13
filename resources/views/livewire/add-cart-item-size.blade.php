<div x-data>
    <div class="mb-6">
        <p class="text-xl"> Talla: </p>

        <select wire:model='size_id' class="form-control w-full">
            <option value="" selected disabled> Seleccione una talla </option>
            @foreach ($sizes as $sz)
                <option value="{{ $sz->id }}"> {{ $sz->name }} </option>
            @endforeach
        </select>
    </div>

    @if ($this->size_id != '')
        <div>
            <p class="text-xl"> Color: </p>

            <select wire:model='color_id' class="form-control w-full">
                <option value="" selected disabled> Seleccione un color </option>
                @foreach ($colors as $color)
                    <option class="capitalize" value="{{ $color->id }}"> {{ __($color->name) }} </option>
                @endforeach
            </select>

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
            @endif
        </div>
    @endif
</div>
