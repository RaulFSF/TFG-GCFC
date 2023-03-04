<div x-data="{ showInfo: false }"
    class="max-w-5xl  mx-auto text-baseText card-gradient shadow-lg py-6 px-4 md:px-6 rounded-lg h-full">
    <div class=" hidden md:flex justify-start items-center space-x-2 text-black mb-4">
        <p>
            Ver por:
        </p>
        <input type="radio" value="history" wire:model="tableType"> <label for="history">Historial</label>
        <input type="radio" value="ratings" wire:model="tableType"> <label for="ratings">Valoraciones</label>
    </div>
    <div class="md:flex justify-between md:space-x-4 items-center mb-8">

        <div class="w-full mb-4 md:mb-0">
            <input type="text" wire:model="search"
                class="rounded h-10 w-full bg-gradient-to-b from-base2 to-base1 border-base1 shadow-lg text-baseText placeholder:text-white placeholder:italic placeholder:font-light"
                placeholder="Buscar jugador...">
        </div>

        <div
            class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:w-2/3 md:w-fit sm:space-x-4 justify-center md:justify-end items-center px-4 bg-baseText py-2 rounded-xl">

            <div class="text-base1 italic">
                Filtrar:
            </div>
            <div class="w-full">
                <select wire:model="categoryFilter" wire:change="filterByCategory"
                    class="w-full border-2 shadow-lg select-gradient border-base1 italic font-light rounded-lg text-baseText text-xs">
                    <option value="-1" selected class="text-baseText text-xs bg-base1">Todas las categorías
                    </option>
                    @foreach ($categoryOptions as $option)
                        <option value="{{ $option->id }}" class="text-baseText text-xs bg-base1">
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if ($is_team_profile == false)
                <div class="w-full">
                    <select wire:model="teamFilter" wire:change="filterByTeam"
                        class="w-full border-2 shadow-lg select-gradient border-base1 italic font-light rounded-lg text-baseText text-xs">
                        <option value="-1" selected class="text-baseText text-xs bg-base1">Todas los equipos
                        </option>
                        @foreach ($teamOptions as $option)
                            <option value="{{ $option->id }}" class="text-baseText text-xs bg-base1">
                                {{ $option->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>


    </div>
    <div wire:loading.block wire:target="filterByCategory"
        class="w-full h-full py-40 flex justify-center items-center space-x-2 bg-baseText rounded-lg shadow-lg">
        <div class="text-center semipolar-spinner w-full mx-auto" :style="spinnerStyle">
            <div class="ring"></div>
            <div class="ring"></div>
            <div class="ring"></div>
            <div class="ring"></div>
            <div class="ring"></div>
        </div>
        <div class="mt-4 text-center">
            <span class="text-xl text-base2">Cargando...</span>
        </div>
    </div>
    <div class="flex-col space-y-4 w-full shadow-lg" wire:loading.remove wire:target="filterByCategory">
        <table class="w-full table-auto text-sm text-left text-gray-500">
            <thead class="text-xs text-baseText uppercase bg-gradient-to-b from-base2 to-base1">
                <tr>
                    @if (!$is_team_profile)
                        <th scope="col" class="px-6 py-3 text-center">
                            Equipo
                        </th>
                    @endif
                    <th scope="col" class="px-2 md:px-6 py-3 text-center">
                        Categoría
                    </th>
                    <th scope="col" class="px-6 py-3 md:text-left text-center">
                        Nombre
                    </th>
                    <th scope="col" class="px-2 py-3 text-center md:table-cell hidden">
                        Edad
                    </th>
                    @if ($tableType === 'history')
                        <th sortable wire:click="sortBy('goals')"
                            :direction="$sortField === 'goals' ? $sortDirection : null" scope="col"
                            class="px-2 py-3 text-center cursor-pointer md:table-cell hidden">
                            <span class="md:block hidden">
                                Goles
                            </span>
                            <span class="md:hidden block">
                                G
                            </span>
                        </th>
                        <th sortable wire:click="sortBy('assits')"
                            :direction="$sortField === 'assits' ? $sortDirection : null" scope="col"
                            class="px-2 py-3 text-center cursor-pointer md:table-cell hidden">
                            <span class="md:block hidden">
                                Asistencias
                            </span>
                            <span class="md:hidden block">
                                A
                            </span>
                        </th>
                        <th sortable wire:click="sortBy('yellow_cards')"
                            :direction="$sortField === 'yellow_cards' ? $sortDirection : null" scope="col"
                            class="px-2 py-3 text-center cursor-pointer md:table-cell hidden">
                            <span class="md:block hidden">
                                Amarillas
                            </span>
                            <span class="md:hidden block">
                                TA
                            </span>
                        </th>
                        <th sortable wire:click="sortBy('red_cards')"
                            :direction="$sortField === 'red_cards' ? $sortDirection : null" scope="col"
                            class="px-2 py-3 text-center cursor-pointer md:table-cell hidden">
                            <span class="md:block hidden">
                                Rojas
                            </span>
                            <span class="md:hidden block">
                                TR
                            </span>
                        </th>
                    @elseif ($tableType === 'ratings')
                        <th scope="col" class="px-2 py-3 text-center">
                            Media
                        </th>
                        <th scope="col" class="px-2 py-3 text-center">
                            Valoraciones
                        </th>
                        <th scope="col" class="px-2 py-3 text-center">
                            Seguidores
                        </th>
                    @endif
                    @if (Auth::user()->role != 'player')
                        <th scope="col" class="px-2 py-3 text-center sm:block hidden">

                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                    @foreach ($players as $key => $history)
                        <tr
                            class="bg-baseText border-b hover:scale-[1.01] duration-200 ease-in-out text-xs sm:text-base" wire:click="$emit('openModal', 'show-player-history-info', {{ json_encode(["history" => $history]) }})">
                            @if (!$is_team_profile)
                                <td class="text-center text-gray-900">
                                    <a
                                        href="{{ route('team.profile.view', ['id' => $history->player->category->team->id]) }}">
                                        {{ $history->player->category->team->name }}
                                    </a>
                                </td>
                            @endif
                            <td class="text-center text-gray-900">
                                {{ $history->player->category->categoryType->name }}
                            </td>
                            <td
                                class="px-2 md:px-6 py-4  font-medium text-gray-900 hover:scale-105 duration-200 ease-in-out ">
                                <a href="{{ route('player.profile.view', ['id' => $history->player_id]) }}"
                                    class="">{{ $history->player->name }}</a>
                            </td>
                            <td class="text-center md:table-cell hidden">
                                {{ $history->player->age }}
                            </td>
                            @if ($tableType === 'history')
                                <td class="text-center md:table-cell hidden">
                                    {{ $history->goals }}
                                </td>
                                <td class="text-center md:table-cell hidden">
                                    {{ $history->assits }}
                                </td>
                                <td class="text-center md:table-cell hidden">
                                    {{ $history->yellow_cards }}
                                </td>
                                <td class="text-center md:table-cell hidden">
                                    {{ $history->red_cards }}
                                </td>
                            @elseif ($tableType === 'ratings')
                                <td class="text-center">
                                    {{-- Media valoraciones --}}
                                    {{ $history->player->scouts->sum('pivot.stars') / $history->player->scouts->count() }}
                                </td>
                                <td class="text-center">
                                    {{-- Cantidad de valoraciones --}}
                                    {{ $history->player->scouts->count() }}
                                </td>
                                <td class="text-center">
                                    {{-- Cantidad de seguidores --}}
                                    {{ $history->player->follows->count() }}
                                </td>
                            @endif
                            @if (Auth::user()->role == 'scout')
                                <td class="text-center sm:flex hidden px-2 flex-col justify-center items-center space-y-2 my-2">
                                    <div class="w-full">
                                        @if ($this->isFollowed($history))
                                            <button
                                                class="w-full px-3 py-2 unfollow-gradient transform active:scale-95 duration-200 ease-in-out transition-transform text-baseText rounded-lg"
                                                wire:click="unfollow({{ $history }})">Dejar de seguir</button>
                                        @else
                                            <button
                                                class="w-full px-3 py-2 select-gradient transform active:scale-95 duration-200 ease-in-out transition-transform text-baseText rounded-lg"
                                                wire:click="follow({{ $history }})">Seguir</button>
                                        @endif
                                    </div>
                                    <div class="md:hidden block w-full">
                                        <button wire:click="$emit('openModal', 'show-player-history-info', {{ json_encode(["history" => $history]) }})"
                                            class="w-full px-3 py-2 bg-gray-400 text-black transform active:scale-95 duration-200 ease-in-out transition-transform rounded-lg">
                                            Ver</button>
                                    </div>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </div>
            </tbody>
        </table>
        <div>
            {{ $players->links() }}
        </div>
    </div>
</div>
