<div class="max-w-5xl mx-auto text-baseText card-gradient shadow-lg py-6 px-6 rounded-lg h-full">
    <div class="flex justify-between space-x-4 items-center mb-8">

        <div class="w-full">
            <input type="text" wire:model="search"
                class="rounded h-10 w-full bg-gradient-to-b from-base2 to-base1 border-base1 shadow-lg text-baseText placeholder:text-white placeholder:italic placeholder:font-light"
                placeholder="Buscar jugador...">
        </div>

        <div class="flex w-fit space-x-4 justify-end items-center px-4 bg-baseText py-2 rounded-xl">

            <div class="text-base1 italic">
                Filtrar:
            </div>
            <div>
                <select wire:model="categoryFilter" wire:change="filterByCategory"
                    class="border-2 shadow-lg select-gradient border-base1 italic font-light rounded-lg text-baseText text-xs">
                    <option value="-1" selected class="text-baseText text-xs bg-base1">Todas las categorías
                    </option>
                    @foreach ($categoryOptions as $option)
                        <option value="{{ $option->id }}" class="text-baseText text-xs bg-base1">
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if (Request::route()->getName() != 'team.profile.view')
                <div>
                    <select wire:model="teamFilter" wire:change="filterByTeam"
                        class="border-2 shadow-lg select-gradient border-base1 italic font-light rounded-lg text-baseText text-xs">
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
                    <th scope="col" class="px-6 py-3 text-center">
                        Categoría
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        Edad
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        Goles
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        Asistencias
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        Amarillas
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        Rojas
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($players as $history)
                    <tr class="bg-baseText border-b hover:scale-[1.01] duration-200 ease-in-out">
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
                        <td class="px-6 py-4 font-medium text-gray-900 hover:scale-105 duration-200 ease-in-out ">
                            <a href="{{ route('player.profile.view', ['id' => $history->player_id]) }}"
                                class="">{{ $history->player->name }}</a>
                        </td>
                        <td class="text-center">
                            {{ $history->player->age }}
                        </td>
                        <td class="text-center">
                            {{ $history->goals }}
                        </td>
                        <td class="text-center">
                            {{ $history->assits }}
                        </td>
                        <td class="text-center">
                            {{ $history->yellow_cards }}
                        </td>
                        <td class="text-center">
                            {{ $history->red_cards }}
                        </td>
                        <td class="text-center px-2">
                            @if ($this->isFollowed($history))
                                <button
                                    class="w-full px-3 py-2 unfollow-gradient transform active:scale-95 duration-200 ease-in-out transition-transform text-baseText rounded-lg"
                                    wire:click="unfollow({{ $history }})">- Dejar de seguir</button>
                            @else
                                <button
                                    class="w-full px-3 py-2 select-gradient transform active:scale-95 duration-200 ease-in-out transition-transform text-baseText rounded-lg"
                                    wire:click="follow({{ $history }})">+ Seguir</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $players->links() }}
        </div>
    </div>
</div>
