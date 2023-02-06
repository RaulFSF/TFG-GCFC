<x-guest-layout>
    <div class="max-w-6xl mx-auto flex justify-center space-x-10">
        @if (Auth::user())
            @if (Auth::user()->role === 'scout')
                <div class="w-1/2 mt-10">
                    <livewire:followed-players />
                </div>
            @endif
        @endif

        <div class="w-1/2 mt-10">
            <livewire:list-matches />
        </div>
    </div>
</x-guest-layout>
