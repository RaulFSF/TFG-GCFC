<x-guest-layout>
    <div class="max-w-5xl mx-auto bg-baseText rounded-xl shadow-xl w-full mt-10 pb-10">
        <div class="mx-4 md:mx-10">
            <div class="flex flex-col md:flex-row justify-between md:space-x-4">
                <div class="flex flex-col justify-center items-center max-h-[90vh] card-gradient rounded-b-xl px-6">
                    <div
                        class="flex flex-col justify-center items-center p-4 bg-opacity-25 bg-base3 rounded-xl space-y-4 my-6">

                        <div class="rounded-full w-32 bg-green-300">
                            <img src="{{ asset($player->image) }}" alt="imagen de perfil"
                                class="w-full h-full rounded-full">
                        </div>

                        <div class="flex-col justify-center text-gray-900">
                            <div>
                                <p>Nombre:
                                    <span class="italic">
                                        {{ $player->name }}

                                    </span>
                                </p>
                            </div>
                            <div>
                                <p>Email:
                                    {{ $player->email }}
                                </p>
                            </div>
                        </div>
                        @if (Auth::user()->role != 'player')
                            <div>
                                <livewire:follow player_id="{{ $player->id }}" />
                            </div>
                        @elseif (Auth::user()->role === 'player' && Auth::user()->id === $player->user_id)
                            <button onclick="Livewire.emit('openModal', 'edit-profile-modal')"
                                class="hover:scale-[1.02] duration-200 ease-in-out border-2 border-white bg-base3 text-base2 text-sm px-4 py-2 rounded-xl">Editar
                                perfil</button>
                        @endif
                    </div>

                </div>
                <div class="mt-4">

                    <h2 class="text-center text-xl text-base2 py-4">Historial de
                        <span class="italic font-normal">
                            {{ $player->name }}
                        </span>
                    </h2>

                    <table class="w-full table-auto text-sm text-left text-gray-500 shadow-xl">
                        <thead class="text-xs text-baseText uppercase bg-gradient-to-b from-base2 to-base1">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Temporada
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Liga
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Equipo
                                </th>
                                <th scope="col" class="px-2 py-3 hidden sm:table-cell">
                                    Goles
                                </th>
                                <th scope="col" class="px-2 py-3 hidden sm:table-cell">
                                    Asistencias
                                </th>
                                <th scope="col" class="px-2 py-3 hidden sm:table-cell">
                                    Amarillas
                                </th>
                                <th scope="col" class="px-2 py-3 hidden sm:table-cell">
                                    Rojas
                                </th>
                                <th scope="col" class="px-2 py-3 text-center">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                                <tr class="bg-baseText border-b hover:scale-[1.01] duration-200 ease-in-out">
                                    <td class="text-center py-4 text-gray-900 px-2">
                                        {{ $history->league->season->name }}
                                    </td>
                                    <td class="text-center text-gray-900">
                                        {{ $history->league->name }}
                                    </td>
                                    <td class="text-center text-gray-900">
                                        {{ $history->category->team->name }}
                                    </td>
                                    <td class="text-center hidden sm:table-cell">
                                        {{ $history->goals }}
                                    </td>
                                    <td class="text-center hidden sm:table-cell">
                                        {{ $history->assits }}
                                    </td>
                                    <td class="text-center hidden sm:table-cell">
                                        {{ $history->yellow_cards }}
                                    </td>
                                    <td class="text-center hidden sm:table-cell">
                                        {{ $history->red_cards }}
                                    </td>
                                    <td class="p-3">
                                        <button onclick='Livewire.emit("openModal", "show-player-season-info", {{ json_encode(["history" => $history]) }})'
                                            class="w-full px-3 py-2 bg-gray-400 text-black transform active:scale-95 duration-200 ease-in-out transition-transform rounded-lg">
                                            Ver
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6">
                <div class="flex justify-between items-center md:items-end mb-4">
                    <h2 class="ml-4 italic text-xl">Mis Valoraciones</h2>
                    @if (Auth::user()->role != 'player')
                        <button
                            onclick="Livewire.emit('openModal', 'add-rating-modal', {{ json_encode(['player' => $player->id]) }})"
                            class="active:scale-100 bg-gradient-to-b text-baseText text-lg duration-500 to-baseText via-base1 from-base1 bg-size-200 bg-pos-0 hover:bg-pos-100 hover:text-base1 px-3 py-2 rounded-xl hover:scale-[1.02] ease-in-out">
                            Agregar valoración</button>
                    @endif
                </div>

                <div class="mx-auto z-20">
                    <div class="ratingSlider select-none md:block hidden">
                        @foreach ($ratings as $rating)
                            <div class="h-32">
                                <x-rating-card :rating="$rating" class="h-full" />
                            </div>
                        @endforeach
                    </div>
                    <div class="ratingSliderMobile select-none md:hidden">
                        @foreach ($ratings as $rating)
                            <div class="h-32">
                                <x-rating-card :rating="$rating" class="h-full" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
