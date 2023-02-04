<div class="space-y-4">
    <div class="w-full mx-auto text-center">
        <h2 class="text-2xl">
            Jugadores seguidos
        </h2>
    </div>
    <div class="w-3/4 mx-auto">
        <input type="text" wire:model="search" class="rounded h-10 w-full" placeholder="Buscar jugador...">
    </div>
    <div class="flex-col space-y-4">
        <table class="w-full table-auto text-sm text-left text-gray-500 border-2 border-black">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Goles
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Asistencias
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Amarillas
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Rojas
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($players as $history)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 font-medium text-gray-900 hover:scale-105 duration-200 ease-in-out ">
                            <a href="/" class="">{{ $history->player->name }}</a>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $players->links() }}
        </div>
    </div>
</div>
