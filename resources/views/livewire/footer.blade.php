<div class="bg-gray-200 py-6 px-4 md:px-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-7 gap-4">
        <div class="col-span-1 lg:col-span-2 border-b-2 lg:border-b-0 lg:border-r-2 border-gray-700 px-2 flex justify-center">
            <div class="text-center lg:text-left">
                <h4 class="text-lg font-semibold">Visita nuestras redes sociales!</h4>
                <div class="mt-2 flex justify-center lg:justify-start space-x-2">
                    <!-- Botones de redes sociales aquí -->
                    <a href="https://www.instagram.com/calux.col/" target="_blank" class="h-10 w-10 flex items-center justify-center rounded-full focus:outline-none m-0.5">
                        <i class="fab fa-instagram text-3xl" style="background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%); -webkit-background-clip: text; color: transparent;"></i>
                    </a>
                    <a href="https://www.facebook.com/calux.co?mibextid=2JQ9oc" target="_blank" class="h-10 w-10 flex items-center justify-center rounded-full focus:outline-none m-0.5">
                        <i class="fab fa-facebook-square text-3xl" style="color: #1877F2;"></i>
                    </a>
                    <a href="https://wa.me/3223402024" target="_blank" class="h-10 w-10 flex items-center justify-center rounded-full focus:outline-none m-0.5">
                        <i class="fab fa-whatsapp text-3xl" style="color: #25D366;"></i>
                    </a>
                    <a href="https://www.tiktok.com/@calux.col?_t=8jkoVbiihBm&_r=1" target="_blank" class="h-10 w-10 flex items-center justify-center rounded-full focus:outline-none m-0.5">
                        <i class="fab fa-tiktok text-3xl"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-span-1 lg:col-span-2 px-2 flex justify-center lg:justify-start">
            <ul class="text-center lg:text-left space-y-2">
                <li>
                    @if ($questions > 0)
                        <a href="{{ route('global.frequently') }}" class="hover:text-pantone-1245"> Preguntas Frecuentes </a>
                    @endif
                </li>
                <li>
                    <a href="{{ route('orders.index') }}" class="hover:text-pantone-1245"> Seguimiento de ordenes </a>
                </li>
            </ul>
        </div>
    </div>
</div>
