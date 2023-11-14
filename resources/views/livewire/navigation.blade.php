<header class="bg-white sticky top-0 z-50" x-data="dropdown()">
    <div class="container flex items-center h-16 justify-between md:justify-start">
        <a :class="{'text-pantone-1255': open}" x-on:click="show()"
            class="flex flex-col items-center justify-center order-last md:order-first px-6 md:px-4 bg-white text-black hover:text-pantone-1255 cursor-pointer font-semibold h-full">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <span class="hover:text-pantone-1255 text-sm hidden md:block">Categorias</span>
        </a>

        <a href="/" class="mx-6">
            <x-jet-application-mark class="block h-9 w-auto" />
        </a>

        <div class="flex-1 hidden md:block">
            @livewire('search')
        </div>

        <div class="ml-3 relative hidden md:block">
            @auth
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('orders.index') }}">
                            Mis ordenes
                        </x-jet-dropdown-link>

                        
                        <x-jet-dropdown-link href="{{ route('admin.index') }}">
                            Administrador
                        </x-jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            @else
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-black text-2xl cursor-pointer"></i>
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Login') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('Register') }}
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>
            @endauth
        </div>
        
        <div class="ml-3 hidden md:block">
          @livewire('dropdown-cart')
        </div>
    </div>

    <nav id="navigation-menu" x-show="open" class="bg-white bg-opacity-25 w-full absolute" style="display:none">
        {{-- Menú en PC --}}
        <div class="container h-full hidden md:block">
            <div x-on:click.away="close()" class="grid grid-cols-4 h-full relative "> 
                <ul class="bg-white">
                    @foreach ($categories as $category)
                        <li class="navigation-link text-black hover:bg-pantone-1255 hover:text-white">
                            <a href="{{ route('categories.show', $category) }}" class="py-2 px-4 text-sm flex items-center">
                                
                                <span class="flex justify-center w-9 px-2">
                                    {!! $category->icon !!}
                                    
                                </span>
                                {{ $category->name }}
                            </a>
                            <div class="navigation-submenu bg-gray-100 absolute w-3/4 h-full top-0 right-0 hidden">
                                <x-navigation-subcategories :category="$category" />
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="col-span-3 bg-gray-100">
                    <x-navigation-subcategories :category="$categories->first()" />
                </div>
            </div>
        </div>

        {{-- Menú en Movil --}}
        <div class="bg-white h-full overflow-y-auto">
            <ul>
                <div class="container bg-pantone-7404 bg-opacity-50 pt-2 py-2 mb-2">
                    @livewire('search')
                </div>

                @foreach($categories as $category)
                    <li class="text-black hover:bg-pantone-1255 hover:text-white">
                        <a href="{{ route('categories.show', $category) }}" class="py-2 px-4 text-sm flex items-center">
                            <span class="flex justify-center w-9 px-2">
                                {!! $category->icon !!}
                            </span>
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
                <p class="px-6 my-2"> USUARIO </p>
                    @livewire('cart-mobile')
                @auth
                    <a href="{{ route('profile.show') }}" class="py-2 px-4 text-sm flex items-center">
                        <span class="flex justify-center w-9 px-2">
                            <i class="fa-regular fa-address-card"></i>
                        </span>
                        Perfil
                    </a>

                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit()" class="py-2 px-4 text-sm flex items-center">
                        <span class="flex justify-center w-9 px-2">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </span>
                        Cerrar sesión
                    </a>

                    <form id='logout-form' action="{{ route('logout') }}" method='post' class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="py-2 px-4 text-sm flex items-center">
                        <span class="flex justify-center w-9 px-2">
                            <i class="fas fa-user-circle text-black text-2xl cursor-pointer"></i>
                        </span>
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}" class="py-2 px-4 text-sm flex items-center">
                        <span class="flex justify-center w-9 px-2">
                            <i class="fa-solid fa-fingerprint"></i>
                        </span>
                        Registrarse
                    </a>
                @endauth
            </ul>
        </div>
    </nav>
</header>