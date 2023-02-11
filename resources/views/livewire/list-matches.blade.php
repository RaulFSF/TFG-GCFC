<div>
    <div class="w-full mx-auto text-center">
        <h2 class="text-2xl mb-3">
            Partidos de la próxima jornada
        </h2>

        <div class="mb-4">
            <select wire:model="search" wire:change="searchLeague"
                class="w-3/4 border-2 shadow-lg select-gradient border-base1 italic font-light rounded-lg text-baseText">
                <option value="-1" selected class="text-baseText text-sm bg-base1">Todas las ligas</option>
                @foreach ($options as $option)
                    <option value="{{ $option->id }}" class="text-baseText text-sm bg-base1">{{ $option->name }} </option>
                @endforeach
            </select>
        </div>

        <div wire:loading.block class="w-full h-full py-40 flex justify-center items-center space-x-2 bg-baseText rounded-lg shadow-lg">
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
            @foreach ($matchDays as $matchDay)
                <div class="mb-4">

                    <div class="text-center w-full bg-gradient-to-b from-base2 to-base1 text-baseText rounded-t-lg py-2">
                        <a class="hover:text-lg duration-200 ease-in-out hover:text-white" href="{{route('league.league', ['league' => $matchDay->league_id])}}">
                            {{ $matchDay->league->name }}
                        </a>
                         - Jornada {{ $matchDay->number }}
                    </div>
                    <div class="rounded-b-lg ">
                        @foreach ($matchDay->categoryMatches as $match)
                        <div class="grid grid-cols-3 pb-2 px-2 hover:scale-[1.01] duration-200 ease-in-out bg-baseText">
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
                                <div>
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
                                <div>
                                    <img src="{{ asset($match->visitor->team->shield_url) }}" alt="escudo del equipo"
                                        class="w-10 h-fit">
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
            @endforeach
        </div>

    </div>
</div>
