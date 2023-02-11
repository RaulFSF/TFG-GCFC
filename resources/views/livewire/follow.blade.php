<div>
    @if ($this->isFollowed())
        <button
            class="w-full px-3 py-2 unfollow-gradient transform active:scale-95 duration-200 ease-in-out transition-transform text-baseText rounded-lg"
            wire:click="unfollow()">- Dejar de seguir</button>
    @else
        <button
            class="w-full px-3 py-2 select-gradient transform active:scale-95 duration-200 ease-in-out transition-transform text-baseText rounded-lg"
            wire:click="follow()">+ Seguir</button>
    @endif
</div>
