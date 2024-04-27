<div class="py-12 sm:px-12 ">
    <h1 class="text-3xl font-bold my-6"> PREGUNTAS FRECUENTES </h1>
    @foreach ($questions as $key => $queo)
        <div class="mt-3" x-data="{ selected: null }">
            <div class="shadow-xl rounded-xl bg-white">
                <div class="py-6 px-4 items-center cursor-pointer font-bold hover:text-pantone-1255" :class="{'text-pantone-1255': selected == '{{ $key }}'}" x-on:click="selected !== {{ $key }} ? selected = {{ $key }} : selected = null">
                    <span class="w-full bg-white border-none py-2"> {{ $queo['question'] }}</span>
                </div>
                <div x-show='selected === {{ $key }}' style="display: none">
                    <div class="py-4 px-4 sm:w-5/6"> {!! nl2br(e($queo->answer)) !!}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
