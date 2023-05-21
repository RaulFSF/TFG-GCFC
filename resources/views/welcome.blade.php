<x-guest-layout>
    <div
        class="max-w-6xl px-4 sm:px-0 mx-auto flex flex-col xl:flex-row justify-center items-center xl:items-start xl:space-x-10">
        @if (Auth::user())
            @if (Auth::user()->role === 'scout')
                <div class="w-full sm:w-2/3 xl:w-1/2 mt-10">
                    <livewire:followed-players />
                </div>
            @endif
        @endif

        @if ($showLeague)
            <div class="w-full sm:w-2/3 xl:w-1/2 mt-10">
                <livewire:list-matches />
            </div>
        @else
            <div class="w-full sm:w-2/3 xl:w-1/2 text-center mt-20 h-[50vh]">
                <p>
                    Lo sentimos no existen ligas de la temporada actual
                </p>
            </div>
        @endif
    </div>
</x-guest-layout>
