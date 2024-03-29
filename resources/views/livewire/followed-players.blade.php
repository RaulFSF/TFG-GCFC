<div class="space-y-4">
    <div class="w-full mx-auto text-center">
        <h2 class="text-2xl text-base2">
            Jugadores seguidos
        </h2>
    </div>
    <div class="w-3/4 mx-auto">
        <input type="text" wire:model="search"
            class="rounded h-10 w-full bg-gradient-to-b from-base2 to-base1 border-base1 shadow-lg text-baseText placeholder:text-white placeholder:italic placeholder:font-light"
            placeholder="Buscar jugador...">
    </div>
    <div class="flex-col w-full shadow-lg">
        <table class="w-full table-auto text-sm text-left text-gray-500">
            <thead class="text-xs text-baseText uppercase bg-gradient-to-b from-base2 to-base1">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Nombre
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        G
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        A
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        TA
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        TR
                    </th>
                    <th scope="col" class="px-10 py-3 text-center">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($players as $history)
                    <tr class="bg-baseText border-b hover:scale-[1.01] duration-200 ease-in-out">
                        <td class="px-6 py-4 font-medium text-gray-900 hover:scale-105 duration-200 ease-in-out ">
                            <a href="{{route('player.profile.view', ['id' => $history->player_id])}}" class="">{{ $history->player->name }}</a>
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
                                    class="w-full text-xs px-1 py-2 unfollow-gradient transform active:scale-95 duration-200 ease-in-out transition-transform text-baseText rounded-lg"
                                    wire:click="unfollow({{ $history }})">- Dejar de seguir</button>
                            @else
                                <button
                                    class="w-full text-xs px-1 py-2 select-gradient transform active:scale-95 duration-200 ease-in-out transition-transform text-baseText rounded-lg"
                                    wire:click="follow({{ $history }})">+ Seguir</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="select-gradient py-4 sm:px-2 rounded-b-lg w-full">
            {{ $players->links() }}
        </div>
    </div>
</div>
