@props(['product'])
<li class="bg-white rounded-lg shadow mb-4">
    <article class="flex">
        <figure>
            <img class="h-48 w-56 object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt='image'>
        </figure>

        <div class="flex-1 py-4 px-6 flex flex-col">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-lg font-semibold"> {{Str::limit($product->name, 20) }} </h1>
                    <p class="font-bold text-pantone-1255"> $ {{ $product->price }} </p>
                </div>

                <div class="flex items-center">
                    <ul class="flex text-sm">
                        <li> <i class="fas fa-star text-yellow-400"></i> </li>
                        <li> <i class="fas fa-star text-yellow-400"></i> </li>
                        <li> <i class="fas fa-star text-yellow-400"></i> </li>
                        <li> <i class="fas fa-star text-yellow-400"></i> </li>
                        <li> <i class="fas fa-star text-yellow-400"></i> </li>
                    </ul>
                    <span class="text-sm"> (24) </span>
                </div>
            </div>

            <div class="mt-auto mb-4">
                <x-danger-enlace href="{{ route('products.show', $product) }}"> Más información </x-danger-enlace>
            </div>
        </div>
    </article>
</li>