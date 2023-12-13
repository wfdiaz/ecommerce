<div class="containerprop py-12">
    <div class="overflow-x-auto">

        <div class="p-2 overflow-hidden flex justify-end">
        </div>
        <div class="p-2 overflow-hidden flex justify-between">
            <div class="w-1/2 p-1">
                <label for="search" class="block text-sm font-medium text-gray-700">Buscar</label>
                <input type="search" id="search" wire:model="search" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                placeholder="Buscar...">
            </div>
            <div class="w-1/2 px-2 py-3 flex justify-end">
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                wire:loading.attr="disabled" wire:target="New" wire:click="New()">
                    Nuevo
                </button>
            </div>
        </div>
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <button wire:offline.attr="disabled" wire:click="order('id')" class="w-full">
                                #
                              @if ($camp == 'id')
                                  {{' '. $icon}}
                              @endif
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <button wire:offline.attr="disabled" wire:click="order('nit')" class="w-full">
                                Nombre
                              @if ($camp == 'nit')
                                  {{' '. $icon}}
                              @endif
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <button wire:offline.attr="disabled" wire:click="order('name')" class="w-full">
                                Ruta
                              @if ($camp == 'name')
                                  {{' '. $icon}}
                              @endif
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <button wire:offline.attr="disabled" wire:click="order('email')" class="w-full">
                                Activo
                              @if ($camp == 'email')
                                  {{' '. $icon}}
                              @endif
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">

                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($news as $new)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ $new->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ $new->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{-- {{ $new->ruta }} --}}
                                <img src="{{ Storage::url($new->ruta) }}" alt="" width="60" style="margin-left: auto; margin-right: auto;">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ $new->active }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{-- <x-button-comp type="edit" class="lg:px-2" wire:click="Edit({{ $new->id }})"></x-button-comp> --}}
                            <button  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" wire:click="Edit({{ $new->id }})">Editar</button>

                            {{-- <x-button-comp type="delete" class="lg:px-2" wire:click="delete({{ $new->id }})"></x-button-comp> --}}
                            <button  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" wire:click="delete({{ $new->id }})">Eliminar</button>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap">No hay datos para visualizar!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-2">
                {{ $news->links() }}
            </div>
        </div>
    </div>
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
    </div>

    <!-- Create Customer Modal -->
    <x-jet-dialog-modal wire:model="modal" id="">
        <x-slot name="title">
            {{ __('Noticias') }}
        </x-slot>

        <x-slot name="content">
            <!-- Title -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="title" value="{{ __('Titulo') }}" />
                <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model="title" autocomplete="Titulo" />
                <x-jet-input-error for="title" class="mt-2" />
            </div>

            <!-- ruta -->
            <div class="col-span-6 sm:col-span-4 p-2 mb-4">
                {{-- <x-jet-label for="ruta" value="{{ __('Ruta') }}" />
                <x-jet-input id="ruta" type="text" class="mt-1 block w-full" wire:model.defer="ruta" autocomplete="ruta" />
                <x-jet-input-error for="ruta" class="mt-2" /> --}}
                {{-- {{ dump($ruta) }} --}}
                @if (!is_null($ruta) and is_null($this->id_new))
                    <img src="{{ $ruta->temporaryUrl() }}" alt="" width="100">
                @else   
                    @if (!is_null($this->id_new))
                        {{-- {{ dd(Storage::url($ruta)) }} --}}
                        <img src="{{ Storage::url($ruta) }}" alt="" width="100">
                    @endif
                @endif
            </div>
            
            <!-- active -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="active" value="{{ __('Activo') }}" />
                <select class="w-full bg-gray-100 text-black border border-gray-200 rounded py-2 px-2 mb-3" wire:model="active">
                    <option value="si">si</option>
                    <option value="no">no</option>
                </select>
                <x-jet-input-error for="active" class="mt-2" />
            </div>

            <!-- image -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="image" value="{{ __('Imagen') }}" />
                <x-jet-input id="image" type="file" class="mt-1 block w-full" wire:model.defer="ruta" autocomplete="ruta" />
                <x-jet-input-error for="image" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="ExitNew" wire:loading.attr="disabled" x-on:click="show = false">
                {{ __('Cancelar') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="SaveNew" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>

