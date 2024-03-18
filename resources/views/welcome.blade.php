<x-app-layout>
    @push('stylesheet')
        {{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> --}}
        {{-- <style>
            .whatsapp-logo {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                max-width: 100px;  /* Establecer el ancho máximo del logo */
                height: auto;      /* Mantener la proporción original de la imagen */
            }
        </style> --}}
    @endpush

    <div id="default-carousel" class="relative bg-white-200 rounded-md" data-carousel="{{ count($images) > 1 ? 'slide' : 'static' }}">
        <div class="mt-6 mx-60 swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    @if ($image->active == "si")
                        <div class="swiper-slide duration-700 ease-linear inset-0 transition-all transform translate-x-0 z-20" data-carousel-item="{{ $loop->first ? 'active' : ''}}">
                            <img class="object-cover w-full h-full"
                                style="max-width: 100%; max-height: 500px;" 
                        
                                {{-- {{ DD(asset('storage/storage/images/' . basename($image->ruta))) }} --}}
                                src="{{ asset('storage/storage/images/' . basename($image->ruta)) }}"
                                {{-- src="{{ asset(str_replace("public/", "public/storage/", $image->ruta)) }}" --}}
                                alt="{{ $image->title }}"
                            />
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

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

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @livewire('footer')
    </div>

    {{-- <a href="https://api.whatsapp.com/send?phone=3173873348" target="_blank" class="whatsapp-logo">
        <img src="{{ asset('storage/images/whatsapp.png') }}" alt="WhatsApp">
    </a> --}}

    @push('script')
     {{-- Noticias --}}
     {{-- <script ></script> --}}
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

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

            var swiper = new Swiper(".mySwiper", {
                cssMode: true,
                navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true, // Habilitar la paginación como cliclable
                },
                mousewheel: true,
                keyboard: true,
                autoplay: {
                    delay: 8000, // Cambiar aquí el intervalo de cambio de imágenes (en milisegundos)
                },
            });
        </script>

    @endpush
</x-app-layout>