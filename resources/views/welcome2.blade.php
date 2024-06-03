<x-app-layout>
    @push('stylesheet')
        <style>
             .category-banner {
            display: flex;
            flex-wrap: wrap; /* Permitir que las categorías se ajusten en varias filas */
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            }
            .category-item {
                text-align: center;
                margin: 0 10px;
                flex: 1 1 calc(20% - 20px); /* Ocupa el 20% del ancho menos el margen */
                box-sizing: border-box; /* Incluye padding y border en el tamaño total */
            }
            .category-item img {
                width: 100%;
                max-width: 300px;
                height: 400px;
                object-fit: cover;
                border-radius: 5px;
            }
            .category-item h1 {
                margin-top: 10px;
                font-size: 1.25rem;
                font-weight: 600;
            }
            .category-item a {
                color: #D4AF37;
                text-decoration: none;
                font-weight: 600;
            }
            .category-item a:hover {
                color: #E5C100;
                text-decoration: underline;
            }

            /* Media Queries para Responsividad */
            @media (max-width: 1200px) {
                .category-item {
                    flex: 1 1 calc(33.33% - 20px); /* Ajusta a 3 categorías por fila en pantallas medianas */
                }
            }
            @media (max-width: 768px) {
                .category-item {
                    flex: 1 1 calc(50% - 20px); /* Ajusta a 2 categorías por fila en pantallas pequeñas */
                    margin-bottom: 20px; /* Añade espacio inferior para separarlos en columnas */
                }
                .category-banner {
                    flex-direction: row; /* Mantiene las categorías en filas horizontales */
                    align-items: center; /* Centra las categorías verticalmente */
                }
                .category-item img {
                    height: 300px; /* Ajusta la altura de las imágenes en pantallas pequeñas */
                }
            }
            @media (max-width: 480px) {
                .category-item {
                    flex: 1 1 100%; /* Toma todo el ancho disponible en pantallas muy pequeñas */
                    margin-bottom: 20px; /* Añade espacio inferior para separarlos en columnas */
                }
                .category-banner {
                    flex-direction: column; /* Colocar las categorías en una columna */
                    align-items: center; /* Centrar las categorías verticalmente */
                }
            }

            .product-gallery {
                display: flex;
                gap: 20px;
                padding-bottom: 20px;
                overflow: hidden; /* Ocultar la barra de desplazamiento horizontal */
                scroll-behavior: smooth; /* Agregar un efecto de desplazamiento suave */
            }

            .product-item {
                flex: 0 0 auto;
                width: 300px;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                overflow: hidden;
                transition: transform 0.3s ease; /* Agregar una transición de desplazamiento */
            }

            .offers-title {
                font-size: 1.5rem;
                font-weight: bold;
                text-transform: uppercase;
                margin-bottom: 20px;
                text-align: center;
            }

            .product-item img {
                width: 100%;
                height: auto;
                object-fit: cover;
            }

            .product-item h1 {
                font-size: 0.875rem;
                font-weight: 600;
                margin: 0.5rem 0;
                text-align: center;
            }

            .product-item p {
                text-align: center;
                color: #d4af37;
            }
        </style>
    @endpush


    <div id="default-carousel" class="relative bg-white-200 rounded-md" data-carousel="{{ count($images) > 1 ? 'slide' : 'static' }}">
        <div class="mt-6 mx-60 swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    @if ($image->active == "si")
                        <div class="swiper-slide duration-700 ease-linear inset-0 transition-all transform translate-x-0 z-20" data-carousel-item="{{ $loop->first ? 'active' : ''}}">
                            <img class="object-cover w-full h-full"
                                style="max-width: 100%; max-height: 500px;" 
                                src="{{ asset('storage/storage/images/' . basename($image->ruta)) }}"
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
        <div class="category-banner">
            @foreach ($categories as $category)
                <div class="category-item">
                    <h1> {{ $category->name }} </h1>
                    <a href="{{ route('categories.show', $category) }}">
                        @if($category->image)
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                        @else
                            <img src="{{ asset('default-category-image.jpg') }}" alt="{{ $category->name }}">
                        @endif
                        <p>Ver más</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    @if ($products->count())

        <div class="containerprop py-8">
            <div class="offers-title">OFERTAS</div>
            <div class="product-gallery" id="product-gallery">
                @foreach($products as $product)
                    <div class="product-item">
                        <a href="{{ route('products.show', $product) }}">
                            <article>
                                <figure class="relative">
                                        <img class="h-full w-full object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt='image' style="aspect-ratio: 1/1;"   >
                                        @if ($product->priceDiscount())
                                            <p class="font-semibold text-black bg-white absolute text-sm bottom-8 left-1 px-1 " :class="{'-translate-y-1 ': select == '{{ $product->id }}'}"> ${{ number_format($product->priceDiscount(), 2, ',', '.') }} </p>
                                        @endif
                                        <p class="font-semibold bg-white absolute text-sm bottom-2 left-1 px-1 @if($product->priceDiscount()) -translate-y-1 @endif @if($product->priceDiscount() != false) line-through text-red-500 @endif">
                                            ${{ number_format($product->price, 2, ',', '.') }}
                                        </p>
                                        
                                </figure>

                                <div class="py-3 px-3">
                                    <h1>{{ Str::limit($product->name, 20) }}</h1>
                                </div>
                            </article>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <button onclick="scrollLeft()">←</button>
                <button onclick="scrollRight()">→</button>
            </div>
        </div>

    @endif

    @push('script')
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
                        clickable: true,
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
                        delay: 6000,
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
                    clickable: true,
                },
                mousewheel: true,
                keyboard: true,
                autoplay: {
                    delay: 8000,
                },
            });

            var scrollAmount = 0;
        var productGallery = document.getElementById('product-gallery');
        var slideTimer;

        window.onload = function() {
            slideTimer = setInterval(scrollNext, 5000);
        }

        function scrollNext() {
            if (scrollAmount >= productGallery.scrollWidth - productGallery.clientWidth) {
                scrollAmount = 0;
            } else {
                scrollAmount += 320; // Ancho de cada producto + margen
            }
            productGallery.scrollTo({
                top: 0,
                left: scrollAmount,
                behavior: 'smooth'
            });
        }

        function scrollLeft() {
            clearInterval(slideTimer);
            if (scrollAmount <= 0) {
                scrollAmount = productGallery.scrollWidth - productGallery.clientWidth;
            } else {
                scrollAmount -= 320;
            }
            productGallery.scrollTo({
                top: 0,
                left: scrollAmount,
                behavior: 'smooth'
            });
            slideTimer = setInterval(scrollNext, 5000);
        }

        function scrollRight() {
            clearInterval(slideTimer);
            if (scrollAmount >= productGallery.scrollWidth - productGallery.clientWidth) {
                scrollAmount = 0;
            } else {
                scrollAmount += 320;
            }
            productGallery.scrollTo({
                top: 0,
                left: scrollAmount,
                behavior: 'smooth'
            });
            slideTimer = setInterval(scrollNext, 5000);
        }
        </script>
    @endpush
</x-app-layout>
