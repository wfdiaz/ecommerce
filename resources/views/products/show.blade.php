<x-app-layout>
    <div class="containerprop py-8">
        <div class="grid md:grid-cols-5 gap-4 md:gap-6">
            <div class="block md:hidden">
                <div class="flex justify-end items-center">
                    <a href="#reviews" class="hover:bg-pantone-1255 flex items-center px-1">
                        <p class="mx-0 flex items-center"> {{ round($product->reviews->avg('rating'), 2) }} <i class="ml-1 fas fa-star text-xs text-yellow-400"></i> <i class="fas fa-star text-xs text-yellow-400"></i> <i class="fas fa-star text-xs text-yellow-400"></i> <i class="fas fa-star text-xs text-yellow-400"></i> <i class="fas fa-star text-xs text-yellow-400"></i>
                            <p class="ml-3 text-pantone-393 hover:text-pantone-1255 underline"> {{ $product->reviews->count() }} </p>
                        </p>
                    </a>
                </div>

                <p> Marca: <a class="capitalize"> {{ $product->brand->name }}</a> </p>
                <h1 class="text-2xl font-bold uppercase"> {{ $product->name }} </h1>

                <p class="text-lg font-bold my-2"> ${{ number_format($product->price, 2, ',', '.') }} </p>
            </div>

            <div class="md:col-span-3">
                <div class="flexslider block md:hidden">
                    <ul class="slides">
                        @foreach ($product->images as $image)
                            <li data-thumb="{{ Storage::url($image->url) }}">
                                <img class="object-cover w-full h-full" src="{{ Storage::url($image->url) }}" style="aspect-ratio: 1/1;"/>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="hidden md:block">
                    <div class="grid grid-cols-2 gap-0.5" >
                        @foreach ($product->images as $key => $image)
                            @if ($product->images->count() % 2 == 0)
                                <img class="object-cover w-full h-full" src="{{ Storage::url($image->url) }}" style="aspect-ratio: 1/1;" />
                            @else
                                @if($key != $product->images->count() - 1) 
                                    <img class="object-cover w-full h-full" src="{{ Storage::url($image->url) }}" style="aspect-ratio: 1/1;" />
                                @else
                                    <img class="object-cover w-full h-full col-span-2" src="{{ Storage::url($image->url) }}" style="aspect-ratio: 2/1;" />

                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="mt-2">
                        <h2 class="font-bold text-lg"> Descripción </h2>
                        {!! $product->description !!}
                    </div>
    
                    @can('review', $product)
                        <div class="mt-4" id="reviews">
                            <h2 class="font-bold text-lg"> Dejar reseña</h2>
    
                            <form action="{{ route('reviews.store', $product) }}" method="post">
                                @csrf
                                <textarea name="comment" id="editor"></textarea>
                                <x-jet-input-error for='comment' />
                    
                                <div class="flex items-center mt-2" x-data="{rating: 5}">
                                    <p class="font-semibold mr-3">Puntaje:</p>
                                    <ul class="flex space-x-2">
                                        <li x-bind:class="rating >= 1 ? 'text-yellow-500' : '' ">
                                            <button type='button' class="focus:outline-none" x-on:click="rating = 1">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        </li>
    
                                        <li x-bind:class="rating >= 2 ? 'text-yellow-500' : '' ">
                                            <button type='button' class="focus:outline-none" x-on:click="rating = 2">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        </li>
    
                                        <li x-bind:class="rating >= 3 ? 'text-yellow-500' : '' ">
                                            <button type='button' class="focus:outline-none" x-on:click="rating = 3">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        </li>
    
                                        <li x-bind:class="rating >= 4 ? 'text-yellow-500' : '' ">
                                            <button type='button' class="focus:outline-none" x-on:click="rating = 4">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        </li>
    
                                        <li x-bind:class="rating >= 5 ? 'text-yellow-500' : '' ">
                                            <button type='button' class="focus:outline-none" x-on:click="rating = 5">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        </li>
                                    </ul>
                                    <input class="hidden" type="number" name='rating' x-model="rating">
    
                                    <x-jet-button class="ml-auto"> Agregar reseña</x-jet-button>
                                </div>
                            </form>
                        </div>
                    @endcan
    
                    @if ($product->reviews->isNotEmpty())
                        <div class="mt-6">
                            <h2 class="font-bold text-lg"> Reseñas </h2>
    
                            <div class="mt-2">
                                @foreach($product->reviews as $review)
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <img class="w-10 h-10 rounded-full object-cover mr-4" src="{{ $review->user->profile_photo_url }}" alt="{{ $review->user->name }}">
                                    </div>
    
                                    <div class="flex-1">
                                        <p class="font-semibold"> {{ $review->user->name }} </p>
                                        <p class="text-sm"> {{ $review->created_at->diffForHumans() }} </p>
                                        <div>
                                            {!! $review->comment !!}
                                        </div>
                                    </div>
    
                                    <div>
                                        <p>
                                            {{ $review->rating }}
    
                                            <i class="fas fa-star text-yellow-500"></i>
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="hidden md:block">
                    <div class="flex justify-end items-center">
                        <a href="" class="hover:bg-pantone-1255 flex items-center px-1">
                            <p class="mx-0 flex items-center"> {{ round($product->reviews->avg('rating'), 2) }} <i class="ml-1 fas fa-star text-xs text-yellow-400"></i> <i class="fas fa-star text-xs text-yellow-400"></i> <i class="fas fa-star text-xs text-yellow-400"></i> <i class="fas fa-star text-xs text-yellow-400"></i> <i class="fas fa-star text-xs text-yellow-400"></i>
                                <p class="ml-3 text-pantone-393 hover:text-pantone-1255 underline"> {{ $product->reviews->count() }} </p>
                            </p>
                        </a>
                    </div>
    
                    <p> Marca: <a class="capitalize"> {{ $product->brand->name }}</a> </p>
                    <h1 class="text-2xl font-bold uppercase"> {{ $product->name }} </h1>
    
                    <p class="text-lg font-bold my-2"> ${{ number_format($product->price, 2, ',', '.') }} </p>
                </div>

                {{-- <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="p-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-pantone-7404">
                            <i class="fas fa-truck text-sm text-white"></i>
                        </span>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-pantone-7404"> Se hacen envíos a todo Colombia </p>
                            <p>Recibelo el {{ Date::now()->addDay(7)->locale('es')->format('l, j F') }}</p>
                        </div>
                    </div>
                </div> --}}

                @if ($product->subcategory->size)
                    @livewire('add-cart-item-size', ['product' => $product])

                @elseif ($product->subcategory->color)
                    @livewire('add-cart-item-color', ['product' => $product])

                @else
                    @livewire('add-cart-item', ['product' => $product])
                @endif
            </div>

            <div class="block md:hidden">
                <div class="mt-2 md:-mt-10">
                    <h2 class="font-bold text-lg"> Descripción </h2>
                    {!! $product->description !!}
                </div>

                @can('review', $product)
                    <div class="mt-4">
                        <h2 class="font-bold text-lg"> Dejar reseña</h2>

                        <form action="{{ route('reviews.store', $product) }}" method="post">
                            @csrf
                            <textarea name="comment" id="editor"></textarea>
                            <x-jet-input-error for='comment' />
                
                            <div class="flex items-center mt-2" x-data="{rating: 5}">
                                <p class="font-semibold mr-3">Puntaje:</p>
                                <ul class="flex space-x-2">
                                    <li x-bind:class="rating >= 1 ? 'text-yellow-500' : '' ">
                                        <button type='button' class="focus:outline-none" x-on:click="rating = 1">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>

                                    <li x-bind:class="rating >= 2 ? 'text-yellow-500' : '' ">
                                        <button type='button' class="focus:outline-none" x-on:click="rating = 2">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>

                                    <li x-bind:class="rating >= 3 ? 'text-yellow-500' : '' ">
                                        <button type='button' class="focus:outline-none" x-on:click="rating = 3">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>

                                    <li x-bind:class="rating >= 4 ? 'text-yellow-500' : '' ">
                                        <button type='button' class="focus:outline-none" x-on:click="rating = 4">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>

                                    <li x-bind:class="rating >= 5 ? 'text-yellow-500' : '' ">
                                        <button type='button' class="focus:outline-none" x-on:click="rating = 5">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                </ul>
                                <input class="hidden" type="number" name='rating' x-model="rating">

                                <x-jet-button class="ml-auto"> Agregar reseña</x-jet-button>
                            </div>
                        </form>
                    </div>
                @endcan

                @if ($product->reviews->isNotEmpty())
                    <div class="mt-6">
                        <h2 class="font-bold text-lg"> Reseñas </h2>

                        <div class="mt-2">
                            @foreach($product->reviews as $review)
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <img class="w-10 h-10 rounded-full object-cover mr-4" src="{{ $review->user->profile_photo_url }}" alt="{{ $review->user->name }}">
                                </div>

                                <div class="flex-1">
                                    <p class="font-semibold"> {{ $review->user->name }} </p>
                                    <p class="text-sm"> {{ $review->created_at->diffForHumans() }} </p>
                                    <div>
                                        {!! $review->comment !!}
                                    </div>
                                </div>

                                <div>
                                    <p>
                                        {{ $review->rating }}

                                        <i class="fas fa-star text-yellow-500"></i>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                } )
                .catch( error => {
                    console.log( error );
                } );
        </script>
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide", 
                });
            });
        </script>
    @endpush
</x-app-layout>