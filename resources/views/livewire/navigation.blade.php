<header class="bg-white sticky top-0 z-50" 
    x-data="{
    ...dropdown(),
    openc: @entangle('openc')}" x-on:mouseleave="openc = null">
    {{-- Menú Movil --}}
    <nav id="navigation-menu" x-show="open" class="bg-white bg-opacity-25 w-full absolute h-screen z-50" style="display: none"
        x-transition:enter="transition ease-linear duration-300"
        x-transition:enter-start="-translate-x-full "
        x-transition:enter-end="traslate-x-100"
        x-transition:leave="transition ease-linear duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full">
        <div class="bg-white flex items-center h-14 border-b border-pantone-1245">
            <a href="/" class="flex-1 mx-4">
                <div class="absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <x-application-logo/>
                </div>
            </a>
            <a x-on:click="close()" class="mx-4 cursor-pointer">
                <x-close />
            </a>
        </div>
        <div class="bg-white h-full overflow-y-auto">
            <ul>
                @foreach($categories as $category)
                    <li class="text-black hover:bg-pantone-1255 hover:text-white">
                        <a href="{{ route('categories.show', $category) }}" class="py-2 px-6 text-lg flex items-center">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach

                <p class="px-6 my-2 border-t border-pantone-1245">  </p>

                <x-jet-dropdown-link class="px-6" href="{{ route('profile.show') }}"> Perfil </x-jet-dropdown-link>
                <x-jet-dropdown-link class="px-6" > Seguimiento de ordenes </x-jet-dropdown-link>

                @auth
                    @role('admin')
                        <x-jet-dropdown-link class="px-6" href="{{ route('admin.index') }}"> Administrador </x-jet-dropdown-link>
                    @endrole

                    <a class="cursor-pointer px-6 block py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        Cerrar sesión
                    </a>

                    <form id='logout-form' action="{{ route('logout') }}" method='post' class="hidden">
                        @csrf
                    </form>
                @else
                    <x-jet-dropdown-link class="px-6" href="{{ route('registro') }}"> Registrarse</x-jet-dropdown-link>
                @endauth
            </ul>
        </div>
    </nav>

    {{-- Search --}}
    <nav id="navigation-search"
        x-show="openserch"
        class="bg-white bg-opacity-25 w-full absolute h-screen z-50" style="display: none"
        x-transition:enter="transition ease-linear duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="traslate-x-0"
        x-transition:leave="transition ease-linear duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full">
        <div class="bg-white flex items-center h-14 border-b border-pantone-1245">
            <a href="/" class="flex-1 mx-4">
                <div class="absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <x-application-logo/>
                </div>
            </a>
            <a x-on:click="closesearch()" class="mx-4 cursor-pointer">
                <x-close />
            </a>
        </div>

        <div class="bg-white h-full overflow-y-auto">
            <div class="containerprop pt-2 py-2 mb-2">
                @livewire('search')
            </div>
        </div>
    </nav>

    {{-- Menú --}}
    <div :class="{'hidden': open}">
        <div class="hidden md:block" x-on:mouseover="openc = null">
            <div class="flex justify-end px-4 sm:px-6 pt-1">
    
                <a href="{{ route('orders.index') }}" class='block text-xs mx-2 leading-5 text-pantone-1255 transition'> Seguimiento de ordenes </a>
                @auth
                    @role('admin')
                        <a href="{{ route('admin.index') }}" class='block text-xs mx-2 leading-5 text-pantone-1255 transition'> Administrador </a>
                    @endrole
                    <a class="block text-xs mx-2 leading-5 text-pantone-1255 transition cursor-pointer" onclick="event.preventDefault(); document.getElementById('logout-form2').submit()">
                        Cerrar sesión
                    </a>
    
                    <form id='logout-form2' action="{{ route('logout') }}" method='post' class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('registro') }}" class='block text-xs mx-2 leading-5 text-pantone-1255 transition'> Registrarse </a>
                @endauth
            </div>
        </div>

        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-end h-14 justify-between md:justify-start border-b border-pantone-1245">
            <a class="block md:hidden cursor-pointer py-3" :class="{'text-pantone-1255': open}" x-on:click="show()"
                class="flex flex-col items-center justify-center order-last md:order-first px-6 md:px-4 bg-white text-black hover:text-pantone-1255 cursor-pointer font-semibold h-full">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </a>
    
            <a href="/" class="flex-none mx-4 pb-3" x-on:mouseover="openc = null">
                {{-- <div class="block md:hidden absolute top-7 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <x-application-logo/>
                </div>
                <div class="hidden md:block ">
                    <x-application-logo/>
                </div> --}}
                <div class="block md:hidden absolute top-7 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center">
                    <x-application-logo/>
                    <!-- Agregar la imagen al lado del logo con un margen a la derecha -->
                    <x-application-logo-col style="margin-left: 10px;"/>
                </div>
                <div class="hidden md:flex items-center">
                    <x-application-logo/>
                    <!-- Agregar la imagen al lado del logo con un margen a la derecha -->
                    <x-application-logo-col style="margin-left: 10px;"/>
                </div>
            </a>
    
            <div class="flex-auto hidden md:block">
                <div class="flex justify-center static xl:absolute xl:top-14 xl:left-1/2 xl:transform xl:-translate-x-1/2 xl:-translate-y-1/2">
                    <a class="py-4 px-4 xl:py-2" x-on:mouseover="openc = null">&nbsp;</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('categories.show', $category) }}" class="py-4 px-4 xl:py-3 text-sm flex items-center transition duration-300" 
                        x-on:mouseover="openc = '{{ $category->id }}'"
                        :class="{ 'border-b-2 border-pantone-1245': openc == '{{ $category->id }}'  }">
                            {{ $category->name }}
                        </a>
                    @endforeach
                    <a class="py-4 px-4 xl:py-2" x-on:mouseover="openc = null">&nbsp;</a>
                </div>
            </div>
    
            <div x-on:mouseover="openc = null">
                <div class="flex items-center py-2">
                    <div class="hidden md:block">
                        @livewire('search')
                    </div>
    
                    <div class="ml-4 relative">
                        <div class="flex items-center">
                            @auth
                                <a href="{{ route('profile.show') }}">
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </button>
                                </a>
                            @else
                                <a href="{{ route('profile.show') }}">
                                    <i class="fas fa-user-circle text-black text-2xl cursor-pointer"></i>
                                </a>
                            @endauth
                        </div>
                    </div>
                    
                    <div class="ml-4 block md:hidden">
                        <div>
                            <a x-on:click="showsearch()" class="cursor-pointer" >
                                <x-search size="22" color="black"/>
                            </a>
                        </div>
                    </div>
    
                    <div class="ml-4">
                        @livewire('dropdown-cart')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="openc !== null" class="w-full absolute bg-white border-b border-pantone-1245">
        <div class="containerprop justify-center flex py-6">
            @foreach ($subcategories as $subcategory)
                <a href="{{ route('categories.show', $cate) . '?subcategoria=' . $subcategory->slug }}" class="px-4 font-bold"> {{ $subcategory->name }}</a>
            @endforeach
        </div>
    </div>
</header>