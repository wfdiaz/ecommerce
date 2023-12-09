<div class="flex-1 relative" x-data="{open: @entangle('open')}" x-on:click.away="open = false" x-on:click="$wire.search ? open = true : open = false">
    <form action="{{ route('search') }}" autocomplete="off">
        <x-jet-input name="name" wire:model="search" type="text" class="w-full h-8" placeholder="Buscar" />
    </form>
    <button class="absolute top-0 right-0 w-12 h-8 flex items-center justify-center rounded-r-md">
        @if ($search)
            <a wire:click='clear'>
                <x-close size="20" color="black" />
            </a>
        @else
            <x-search size="20" color="black" />
        @endif
    </button>

    <div class="hidden md:block">
        <div class="absolute hidden w-full md:w-96 md:end-0 md:top-10" :class="{ 'hidden' : !open }" style="margin-top: 0.5px">
            <div class="bg-white shadow-md">
                <div class="px-4 py-3 space-y-1">
                       <p class="font-bold text-xl pb-4"> Productos </p>
                    @forelse ($products as $product)
                        <a href="{{ route('products.show', $product) }}" class="flex">
                            <img class="w-20 h-20 object-cover" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                            <div class="ml-4">
                                <p class="text-pantone-393 pb-2">{{$product->subcategory->category->name}}</p>
                                <p class="text-md  leading-5">{{$product->name}}</p>
                                <p class="text-sm  leading-5"> $ {{ number_format($product->price, 2)}}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-lg leading-5">
                            No existe ningún registro con los parametros especificados
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="block md:hidden">
        <div class="py-3 px-3 space-y-1 mt-3 bg-white" :class="{ 'hidden' : !open }">
            @forelse ($products as $product)
                <a href="{{ route('products.show', $product) }}" class="flex">
                    <img class="w-20 h-20 object-cover" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                    <div class="ml-4">
                        <p class="text-pantone-393 pb-2">{{$product->subcategory->category->name}}</p>
                        <p class="text-md  leading-5">{{$product->name}}</p>
                        <p class="text-sm  leading-5"> $ {{ number_format($product->price, 2)}}</p>
                    </div>
                </a>
            @empty
                <p class="text-md leading-5">
                    No existe ningún registro con los parametros especificados
                </p>
            @endforelse
        </div>
    </div>
</div>