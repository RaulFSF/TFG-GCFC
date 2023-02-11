<div {{$attributes}}>
    <div class="bg-white rounded-xl p-4 text-base2 space-y-2">
        <div class="flex justify-between items-center ">
            <div class="flex items-center justify-center space-x-2">
                <div>
                    <img src="{{ asset($scout->user->image_url) }}" alt="imagen de {{ $scout->user->name }}"
                        class="w-8 h-full rounded-full">
                </div>
                <div class="text-sm">
                    <h3>{{ $scout->user->name }}</h3>
                </div>
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
            <p class="line-clamp-3">
                {{ $rating->comment }}
            </p>
        </div>
        <div class="text-right">
            {{ $humanDate }}
        </div>
    </div>
</div>
