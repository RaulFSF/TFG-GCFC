<x-guest-layout>
    @if ($showLeague)
        <livewire:league-classification-match-day :league_id='$league_id' />
    @else
        <div class="w-full sm:w-2/3 xl:w-1/2 mx-auto text-center mt-20 h-[50vh]">
            <p>
                Lo sentimos no existen ligas de la temporada actual
            </p>
        </div>
    @endif
</x-guest-layout>
