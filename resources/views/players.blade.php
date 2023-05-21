<x-guest-layout>
    <div class="mt-10">
        @if ($seasonAvailable)
            <livewire:search-player />
        @else
            <div class="mx-auto text-center">
                Lo sentimos no hay historiales disponibles
            </div>
        @endif
    </div>
</x-guest-layout>
