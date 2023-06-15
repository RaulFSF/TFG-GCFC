<div {{ $attributes }}>
    <div class="bg-white rounded-xl p-4 text-base2 space-y-2 h-full flex flex-col justify-between">
        <div class="flex justify-between items-center space-x-2">
            <div class="flex items-start justify-center space-x-2">
                @if (auth()->user()->role === 'scout')
                    <div class="min-w-fit">
                        <img src="{{ asset($player->image) }}" alt="imagen de {{ $player->name }}"
                            class="w-8 h-8 object-cover rounded-full">
                    </div>
                    <div class="text-xs font-medium">
                        <h3>{{ $player->name }}</h3>
                    </div>
                @elseif (auth()->user()->role === 'player')
                    <div class="text-xs font-medium">
                        <h3>Anónimo</h3>
                    </div>
                @endif
            </div>
            <div class="flex justify-center items-center space-x-1">
                <div>
                    <x-icons.star class="text-yellow-600 w-4 h-fit" />
                </div>
                <div class="mb-[2px]">
                    <span>{{ $rating->stars }}/5</span>
                </div>
            </div>
        </div>
        <div>
            <p class="line-clamp-2 text-xs">
                {{ $rating->comment }}
            </p>
        </div>
        <div class="text-right text-xs">
            {{ $humanDate }}
        </div>
    </div>
</div>
