<div class="mt-10 max-w-6xl mx-auto flex space-x-6 items-start">
    <div class="w-full">

        <div class="mb-4 w-3/4 mx-auto">
            <select wire:model="search" wire:change="searchLeague"
                class="w-full mx-auto border-2 shadow-lg select-gradient border-base1 italic font-light rounded-lg text-baseText">
                @foreach ($options as $option)
                    <option value="{{ $option->id }}" class="text-baseText text-sm bg-base1">{{ $option->name }} </option>
                @endforeach
            </select>
        </div>

        <div wire:loading.block wire:target="searchLeague"
            class="w-full h-full py-20 flex justify-center items-center space-x-2 bg-baseText rounded-lg shadow-lg">
            <div class="text-center semipolar-spinner w-full mx-auto" :style="spinnerStyle">
                <div class="ring"></div>
                <div class="ring"></div>
                <div class="ring"></div>
                <div class="ring"></div>
                <div class="ring"></div>
            </div>
            <div class="mt-2 flex justify-center">
                <span class="text-xl">Cargando...</span>
            </div>
        </div>

        <div wire:loading.remove wire:target="searchLeague">
            <div class="flex-col space-y-4 w-full shadow-lg">
                <table class="w-full table-auto text-sm text-left text-gray-500">
                    <thead class="text-xs text-baseText uppercase select-gradient">
                        <tr>
                            <th scope="col" class="pl-4 py-3 w-20">
                                Puesto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Club
                            </th>
                            <th scope="col" class="py-3">
                                PTS
                            </th>
                            <th scope="col" class="px-2 py-3">
                                J
                            </th>
                            <th scope="col" class="px-2 py-3">
                                G
                            </th>
                            <th scope="col" class="px-2 py-3">
                                E
                            </th>
                            <th scope="col" class="px-2 py-3">
                                P
                            </th>
                            <th scope="col" class="px-2 py-3">
                                GF
                            </th>
                            <th scope="col" class="px-2 py-3">
                                GC
                            </th>
                            <th scope="col" class="px-2 py-3">
                                DF
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($league_teams as $team)
                            <tr class="bg-baseText border-b hover:scale-[1.01] duration-200 ease-in-out group">
                                <td class="text-left pl-4">
                                    {{ $team->position }}
                                </td>
                                <td
                                    class="px-6 py-4 font-medium text-gray-900 hover:scale-105 duration-200 ease-in-out">
                                    <a href="/" class="w-full">
                                        <div class="flex items-center justify-start space-x-5 ">
                                            <img src="{{ asset($team->category->team->shield_url) }}"
                                                alt="escudo de {{ $team->category->team->name }}" class="w-10 h-full group-hover:animate-bounce">
                                            <p>{{ $team->category->team->name }}</p>
                                        </div>
                                    </a>
                                </td>
                                <td class="">
                                    {{ $team->points }}
                                </td>
                                <td class="">
                                    {{ $team->played }}
                                </td>
                                <td class="">
                                    {{ $team->wins }}
                                </td>
                                <td class="">
                                    {{ $team->draws }}
                                </td>
                                <td class="">
                                    {{ $team->losts }}
                                </td>
                                <td class="">
                                    {{ $team->goals_scored }}
                                </td>
                                <td class="">
                                    {{ $team->goals_against }}
                                </td>
                                <td class="">
                                    {{ $team->goals_scored - $team->goals_against }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="w-2/3">
        <div class="w-full mx-auto text-center bg-base3 p-5 rounded-lg shadow-lg">
            <div class="mb-4">
                <select wire:model="searchMatchDay" wire:change="searchMatchDay"
                    class="w-3/4 border-2 shadow-lg select-gradient border-base1 italic font-light rounded-lg text-baseText">
                    @foreach ($options_matchDays as $option)
                        <option value="{{ $option->id }}" class="text-baseText text-sm bg-base1">{{ $option->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div wire:loading.block
                class="w-full h-full py-40 flex justify-center items-center space-x-2 bg-baseText rounded-lg shadow-lg">
                <div class="text-center semipolar-spinner w-full mx-auto" :style="spinnerStyle">
                    <div class="ring"></div>
                    <div class="ring"></div>
                    <div class="ring"></div>
                    <div class="ring"></div>
                    <div class="ring"></div>
                </div>
                <div class="mt-2">
                    <span class="text-xl">Cargando...</span>
                </div>
            </div>

            <div wire:loading.remove>
                <div class="mb-4 w-full">
                    <div class="rounded-b-lg ">
                        @foreach ($category_matches['categoryMatches'] as $match)
                            <div
                                class="grid grid-cols-3 pb-2 px-2 hover:scale-[1.01] duration-200 ease-in-out bg-baseText group">
                                <div class="col-span-3 pt-4 pb-1">
                                    <a href="{{ $match->local->team->field[0]['address'] }}" target="blank"
                                        class="w-fit bg-base3 rounded-lg text-gray-600 py-1 px-2 flex space-x-1 justify-center items-center mx-auto hover:scale-[1.02] duration-200 ease-in-out">

                                        <x-icons.location class="text-gray-600 w-4 h-4" />

                                        <span class="text-sm">{{ $match->local->team->field[0]['name'] }}</span>

                                    </a>
                                </div>
                                <div class="flex items-center justify-end space-x-2">
                                    <div>
                                        {{ $match->local->team->name }}
                                    </div>
                                    <div class="group-hover:animate-bounce">
                                        <img src="{{ asset($match->local->team->shield_url) }}" alt="escudo del equipo"
                                            class="w-10 h-fit">
                                    </div>
                                </div>
                                <div class="flex-col justify-center items-center mx-2">
                                    <div>
                                        {{ $match->date }}
                                    </div>
                                    <div>
                                        @if ($match->local_score && $match->visitor_score)
                                            <div>
                                                {{ $match->local_score }} - {{ $match->visitor_score }}
                                            </div>
                                        @else
                                            <div>
                                                0 - 0
                                            </div>
                                        @endif
                                    </div>

                                </div>

                                <div class="flex items-center justify-start space-x-2">
                                    <div class="group-hover:animate-bounce">
                                        <img src="{{ asset($match->visitor->team->shield_url) }}"
                                            alt="escudo del equipo" class="w-10 h-fit">
                                    </div>
                                    <div>
                                        {{ $match->visitor->team->name }}
                                    </div>
                                </div>

                            </div>
                            <div class="h-[1px] w-full bg-base3 col-span-3"> </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
