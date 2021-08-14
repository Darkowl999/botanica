<div>
    <div class="flex justify-center pb-10 space-x-2">

        <button type="button"
                class="w-24 h-10 bg-white border border-black text-center text-black font-semibold rounded-md ">{{'Libre'}}</button>
        <button
            class="w-24 h-10 bg-red-500 border border-black text-center text-white font-semibold rounded-md">{{'Ocupado'}}</button>
        <button
            class="w-24 h-10 bg-green-500 border border-black text-center text-white font-semibold rounded-md">{{'Reservado'}}</button>
    </div>
    <div class="grid grid-cols-8 gap-4">
        @foreach($mesas as $m)
            @if($m->estado==='Libre')
                <button wire:click="mesaModal({{$m->id}})"
                        class="bg-white hover:bg-gray-500 shadow-2xl rounded-md h-24 border border-black text-black text-center text-5xl font-semibold">
                    {{$m->id}}
                </button>
            @else
                <button wire:click="mesaModal({{$m->id}})"
                        class="{{$m->estado==='Ocupado'?'bg-red-500 hover:bg-red-700':'bg-green-500 hover:bg-green-700'}} border border-black shadow-2xl rounded-md h-24 text-white text-center text-5xl font-semibold">
                    {{$m->id}}
                </button>
            @endif
        @endforeach
    </div>

    @if($mesa!=null)
        <x-jet-dialog-modal wire:model="mesaModal" wire:click="$toggle('mesaModal')">
            <x-slot name="title">
                Mesa {{$mesa->id}}
            </x-slot>

            <x-slot name="content">
                <div x-data="{active: 0}">
                    <div class="flex border border-black rounded-t-md overflow-hidden -mb-px">
                        <button class="px-4 py-2 w-full rounded-tl-md" x-on:click.prevent="active = 0"
                                x-bind:class="{'bg-gray-700 text-white': active === 0}">Detalles
                        </button>
                        <button class="px-4 py-2 w-full rounded-tr-md" x-on:click.prevent="active = 1"
                                x-bind:class="{'bg-gray-700 text-white': active === 1}">Editar
                        </button>
                    </div>
                    <div class="bg-white rounded-b-md border border-black -mt-px">
                        <div class="p-4 space-y-2" x-show="active === 0">

                        </div>
                        <div class="p-4 space-y-2" x-show="active === 1">
                            <form wire:submit.prevent="save" class="px-10">
                                <div>
                                    <x-jet-label for="capacidad" value="{{ __('Capacidad') }}"/>
                                    <x-jet-input id="capacidad" wire:model="capacidad" class="block mt-1 w-full"
                                                 type="text" name="capacidad" required/>
                                </div>
                                <div>
                                    <x-jet-label for="area" value="{{ __('Area') }}"/>
                                    <select wire:model="area_id" name="area" id="area"
                                            class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        @foreach($areas as $area)
                                            <option
                                                value="{{$area->id}}" {{$area->id===$mesa->area_id?'selected':''}}>{{$area->nombre}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>
