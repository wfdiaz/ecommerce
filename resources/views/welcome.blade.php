<x-app-layout>
    <div class="containerprop py-8">
        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase font-semibold"> {{ $category->name }} </h1>
                    <a href="{{ route('categories.show', $category) }}" class="text-pantone-1245 hover:text-pantone-393 hover:underline ml-2 font-semibold"> Ver más </a>
                </div>

                @livewire('category-products',['category' => $category])
            </section>
        @endforeach
    </div>

    @push('script')
        <script>
            Livewire.on('glid', function($id){
                new Swiper(document.querySelector('.swiper-' + $id), {
                    slidesPerView: 2.5,
                    spaceBetween: 3,
                    navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: 'swiper-pagination',
                        clickable: true, // Habilitar la paginación como cliclable
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 3.5,
                            spaceBetween: 4,
                        },
                        960: {
                            slidesPerView: 4.5,
                            spaceBetween: 5,
                        },
                        1100: {
                            slidesPerView: 5.5,
                            spaceBetween: 5,
                        },
                        1440: {
                            slidesPerView: 6.5,
                            spaceBetween: 10,
                        }
                    },
                    mousewheel: false,
                    allowTouchMove: true,
                    keyboard: true,
                    autoplay: {
                        delay: 6000, // Cambiar aquí el intervalo de cambio de imágenes (en milisegundos)
                    },
                });
            })
        </script>
    @endpush
</x-app-layout>