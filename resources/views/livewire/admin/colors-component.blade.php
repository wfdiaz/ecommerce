<div class="containerprop py-12">
    {{-- Agregar Color --}}
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Agregar un nuevo color
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder agregar un nuevo color
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label> Color </x-jet-label>
                <x-jet-input wire:model.defer="createForm.name" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.name" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved"> Color agregado </x-jet-action-message>
            <x-jet-button> Agregar </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    {{-- Mostrar Colores --}}
    <x-jet-action-section>
        <x-slot name="title">
            Lista de Colores
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas los Colores agregados
        </x-slot>

        <x-slot name="content">

            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @foreach ($colors as $color1)
                        <tr>
                            <td class="py-2">
                                {{$color1->name}}
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit({{$color1}})"> Editar </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>

    {{-- Modal editar --}}
    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar color
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">
                <div>
                    <x-jet-label> Color </x-jet-label>
                    <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1" />
                    <x-jet-input-error for="editForm.name" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update"> Actualizar </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>