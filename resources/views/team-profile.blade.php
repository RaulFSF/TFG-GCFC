<x-guest-layout>
    <div class="max-w-5xl mx-auto bg-baseText rounded-xl shadow-xl w-full mt-10 pb-10">
        <div class="md:mx-10 mx-4">
            <div
                class="flex flex-col justify-center items-center card-gradient max-w-2xl mx-auto rounded-b-xl px-6">
                <div
                    class="flex flex-col justify-center items-start p-4 bg-opacity-25 bg-base3 my-4 rounded-xl space-y-4 w-full">
                    <div class="flex flex-col md:flex-row w-full justify-center items-center">

                        <div class="w-40 mx-auto">
                            <img src="{{ asset($team->shield) }}" alt="imagen de perfil" class="w-full h-full">
                        </div>

                        <div class="flex-col justify-center text-gray-900">
                            <div>
                                <h2 class="text-center md:text-left text-2xl mb-8">
                                    {{ $team->name }}
                                </h2>
                            </div>
                            <div>
                                Datos del administrador:
                                <ul class="list-disc list-inside ml-2">
                                    <li> Nombre: <span> {{ $team->administrator->name }} </span> </li>
                                    <li> Email: <span> {{ $team->administrator->email }} </span> </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="self-start mt-4 text-sm">
                        {{ $team->description }}
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <h2 class="text-2xl italic ml-2 text-base2 mb-3">
                    Jugadores del {{$team->name}}
                </h2>
                <livewire:search-player team_id="{{ $team->id }}" />
            </div>
        </div>
    </div>
</x-guest-layout>
