<div class="containerprop py-12">
    <x-jet-button wire:loading.attr="disabled" wire:target="new" wire:click="new">
        Agregar
    </x-jet-button>
    {{-- {{ dd($questions) }} --}}
    <div class="mt-3" x-data="{ selected: null }">
        @foreach ($questions as $key => $queo)
            <div class="shadow-xl rounded-xl bg-white py-2 mb-4">
                <div
                    x-on:click="selected !== {{ $key }} ? selected = {{ $key }} : selected = {{ $key }}">
                    <div class="my-3 mx-3 px-4 items-center">
                        <div x-show='selected != {{ $key }}' class="cursor-pointer">
                            <span class="w-full bg-white border-none py-2"> {{ $queo['question'] }}</span>
                        </div>

                        <div class="flex items-center" x-show='selected === {{ $key }}' style="display: none;">
                            <label class="mr-3"> Pregunta </label>
                            <textarea wire:model.lazy='questions.{{ $key }}.question'
                                class="w-full h-auto bg-white border-none py-2 px-4 flex justify-center focus:outline-none focus:ring-1 focus:ring-blue-900 focus:border-transparent"
                               rows="1"  style="border-bottom: 2px solid #023e7d;"></textarea>
                        </div>
                    </div>
                    <div x-show='selected === {{ $key }}'
                        class="my-3 px-4 flex items-center border-t-2 border-gray-500 py-2" style="display: none;">
                        <label class="mr-3"> Respuesta </label>

                        <textarea wire:model.lazy='questions.{{ $key }}.answer'
                            class="w-full bg-white h-auto py-2 px-4 focus:outline-none focus:ring-1 focus:ring-blue-900 focus:border-transparent"
                            rows="9" ></textarea>
                    </div>

                    <div x-show='selected === {{ $key }}' class="mb-3 ml-3 mr-3" style="display: none;">
                        <div class="w-full flex items-center">
                            <i class="inline-flex far fa-copy mr-2 ml-4 text-gray-900 justify-center cursor-pointer"
                                wire:click='copy({{ $key }})'></i>
                            <i class="inline-flex far fa-trash-alt mr-2 ml-4 text-gray-900 justify-center cursor-pointer"
                                wire:click='deleteque({{ $key }})'></i>

                            <div class="ml-3 flex-1 px-4 items-center" style="border-left: 2px solid #5f6a75">
                                <div class="flex items-center">
                                    <label class=" py-2 mr-2 text-sm font-medium text-black cursor-pointer"> Publicar:
                                    </label>
                                    <label class=" flex items-center cursor-pointer mr-4"
                                        for="pub{{ $key }}si">
                                        <span class="mr-2 "> Si </span>
                                        <input id="pub{{ $key }}si"
                                            wire:model.lazy="questions.{{ $key }}.status" type='radio'
                                            value="1">
                                        <span class="font-semibold ml-auto"></span>
                                    </label>

                                    <label class=" flex items-center cursor-pointer" for="pub{{ $key }}no">
                                        <span class="mr-2"> No </span>
                                        <input id="pub{{ $key }}no"
                                            wire:model.lazy="questions.{{ $key }}.status" type='radio'
                                            value="0">
                                    </label>

                                    <span class="text-right ml-11-4">
                                        <span class="inline-flex ml-3 items-center">
                                            <label class="py-2 ml-2 text-sm font-medium text-black"> Posición: </label>

                                            <select class="h-10 ml-3 cursor-pointer"
                                                wire:model='questions.{{ $key }}.order'>
                                                @for ($i = 1; $i <= count($this->questions); $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div>
                                {{-- <x-jet-button wire:loading.attr="disabled">
                                    Opciones Avanzadas
                                </x-jet-button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
