<a {{ $attributes->merge(['type' => 'submit', 'class' => ' justify-center inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition']) }}>
    {{ $slot }}
</a>