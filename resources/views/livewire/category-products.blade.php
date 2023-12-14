<div wire:init='loadProducts' x-data="{select: null}">
    @if (count($products))
        <div class="swiper swiper-{{ $category->id }}">
            <!-- Additional required wrapper -->
            <ul class="swiper-wrapper">
                <!-- Slides -->
                @foreach($products as $product)
                
                    <li class="swiper-slide bg-white {{ $loop->last ? '' : 'sm:mr-4' }} " x-on:mouseover="select = {{ $product->id }}" x-on:mouseleave="select = null">
                        <a href="{{ route('products.show', $product) }}">
                            <article>
                                <figure>
                                    {{-- @if ($product->images->count()) --}}
                                        <img class="h-full w-full object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt='image' style="aspect-ratio: 1/1;"   >
                                    {{-- @else
                                        <img class="h-48 w-full object-cover object-center" alt='image'>
                                    @endif --}}
                                
                                </figure>
                                <div class="py-3 px-3">
                                    <h1 class="text-sm md:text-md text-black font-semibold">
                                        {{Str::limit($product->name, 20) }}
                                    </h1>
                                    <p class="font-semibold text-black bg-white absolute text-sm bottom-12 left-1 px-1 " :class="{'-translate-y-1 ': select == '{{ $product->id }}'}"> ${{ number_format($product->price, 2, ',', '.') }} </p>
                                </div>
                            </article>
                        </a>
                    </li>
                @endforeach
            </ul>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
    @else
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>
    @endif
</div>
