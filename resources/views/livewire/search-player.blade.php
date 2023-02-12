<div class="max-w-5xl mx-auto text-baseText card-gradient shadow-lg py-6 px-6 rounded-lg h-full">
    <div class="w-3/4 mx-auto mb-8">
        <input type="text" wire:model="search"
            class="rounded h-10 w-full bg-gradient-to-b from-base2 to-base1 border-base1 shadow-lg text-baseText placeholder:text-white placeholder:italic placeholder:font-light"
            placeholder="Buscar jugador...">
    </div>
    <div class="flex-col space-y-4 w-full shadow-lg">
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
                                <a href="{{ route('team.profile.view', ['id' => $history->player->category->team->id]) }}">
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
