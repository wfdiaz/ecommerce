<div x-data>
    <p class="mb-4"> 
        <span class="font-semibold text-lg"> Stock disponible :</span> {{ $quantity }}
    </p>

    <div class="flex items-center">
        <div class="mr-4">
            <x-jet-secondary-button disabled x-bind:disabled="$wire.qty <= 1" wire:loading.attr="disabled" wire:target='decrement' wire:click='decrement'> - </x-jet-secondary-button>
            <span class="mx-2">{{ $qty }}</span>
            <x-jet-secondary-button x-bind:disabled="$wire.qty >= $wire.quantity" wire:loading.attr="disabled" wire:target='increment' wire:click='increment'> + </x-jet-secondary-button>
        </div>

        <div class="flex-1">
            <x-button class="w-full bg-pantone-393 hover:bg-pantone-1245 active:bg-pantone-1245 focus:border-pantone-1245 focus:ring-pantone-393"
            x-bind:disabled="$wire.qty > $wire.quantity" wire:click='addItem' wire:loading.attr="disabled" wire:target='addItem'> Agregar al carrito de compras </x-button>
        </div>
    </div>
</div>
