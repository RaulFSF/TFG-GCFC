<?php

namespace App\Http\Livewire;

use App\Models\PlayerHistory;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ShowPlayerSeasonInfo extends ModalComponent
{
    public $history;
    public function render()
    {
        $this->history = PlayerHistory::where('id', $this->history['id'])->first();
        return view('livewire.show-player-season-info');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }
}
