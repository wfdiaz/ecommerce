<div class="bg-gray-200 py-6 px-4 md:px-12 ">
    <div class="grid grid-cols-7">
        <div class="col-span-2 border-2 border-r-gray-700 px-2 flex justify-center">
            <div>
                <h4 class="text-lg font-semibold">Visita nuestras redes sociales!</h4>
                <div class="mt-2">
                    <!-- Botones de redes sociales aquí -->
                    <button
                        class="h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none m-0.5"
                        type="button">
                        <a href="https://www.instagram.com/calux.col/" target="_blank">
                            <i class="fab fa-instagram text-3xl"
                                style="background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%); -webkit-background-clip: text; color: transparent;"></i>
                        </a>

                    </button>
                    <button
                        class="h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none m-0.5"
                        type="button">
                        <a href="https://www.facebook.com/calux.co?mibextid=2JQ9oc" target="_blank">
                            <i class="fab fa-facebook-square text-3xl" style="color: #1877F2;"></i>
                        </a>
                    </button>
                    <button
                        class="h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none m-0.5"
                        type="button">
                        <a href="https://wa.me/3223402024" target="_blank">
                            <i class="fab fa-whatsapp text-3xl" style="color: #25D366;"></i>
                        </a>
                    </button>
                    <button
                        class="h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none m-0.5"
                        type="button">

                        <a href="https://www.tiktok.com/@calux.col?_t=8jkoVbiihBm&_r=1" target="_blank">
                            <i class="fab fa-tiktok text-3xl"></i>
                        </a>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-span-2 px-2 flex justify-center">
            <ul>
                <li>
                    @if ($questions > 0)
                        <a href="{{ route('global.frequently') }}" class="hover:text-pantone-1245"> Preguntas Frecuentes </a>
                    @endif
                </li>
                <li>
                    <a href="{{ route('orders.index') }}" class='hover:text-pantone-1245'> Seguimiento de ordenes </a>

                </li>
            </ul>

        </div>
    </div>
</div>
