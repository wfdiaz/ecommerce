<div>
    <x-jet-dropdown>
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">
                <x-cart color="black" size='30'/>
                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">2</span>
            </span>
        </x-slot>

        <x-slot name="content">
            <div class="py-6 px-4">
                <p class="text-center">
                    No tiene agregado ningun item en el carrito
                </p>
            </div>
         
            {{-- <x-jet-dropdown-link href="{{ route('login') }}">
                {{ __('Login') }}
            </x-jet-dropdown-link>

            <x-jet-dropdown-link href="{{ route('register') }}">
                {{ __('Register') }}
            </x-jet-dropdown-link> --}}
        </x-slot>
    </x-jet-dropdown>
</div>
