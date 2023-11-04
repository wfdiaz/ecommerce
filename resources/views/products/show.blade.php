<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($product->images as $image)
                            <li data-thumb="{{ Storage::url($image->url) }}">
                                <img src="{{ Storage::url($image->url) }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div>
                <h1 class="text-xl font-bold"> {{ $product->name }} </h1>

                <div class="flex">
                    <p> Marca: <a class="underline capitalize hover:text-pantone-393" href=""> {{ $product->brand->name }}</a></p>
                    <p class="mx-6"> 5 <i class="fas fa-star text-sm text-yellow-400"></i> </p>
                    <a class="text-pantone-393 hover:text-pantone-1255 underline"> 39 reseñas </a>
                </div>

                <p class="text-2xl font-semibold my-4"> COP {{ $product->price }} </p>

                <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="p-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-pantone-7404">
                            <i class="fas fa-truck text-sm text-white"></i>
                        </span>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-pantone-7404"> Se hacen envíos a todo Colombia </p>
                            <p>Recibelo el {{ Date::now()->addDay(7)->locale('es')->format('l, j F') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });
        </script>
    @endpush
</x-app-layout>