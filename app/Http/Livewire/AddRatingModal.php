<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class AddRatingModal extends ModalComponent
{
    public $user;
    public $name;
    public $stars;
    public $comment;
    public $player_id;

    public function mount($player)
    {
        $this->player_id = $player;
        $this->user = auth()->user();
        $this->name = $this->user->name;
    }

    public function render()
    {
        return view('livewire.add-rating-modal');
    }

    public function save()
    {
        $this->validate([
            'stars' => ['required', 'integer','between:0,5'],
            'comment' => ['required', 'max:255', 'min:3'],
        ],[
            'stars.required' => 'Requerido',
            'stars.integer' => 'Número no válido',
            'stars.between' => 'Número erróneo',
            'comment.required' => 'Requerido',
            'comment.max' => 'Comentario demasiado largo',
            'comment.min' => 'Comentario demasiado corto',
        ]);

        $rating = [
            'player_id' => $this->player_id,
            'scout_id' => $this->user->scout->id,
            'date' => Carbon::now()->format('Y-m-d h:i:s'),
            'stars' => $this->stars,
            'comment' => $this->comment,
        ];

        DB::table('player_scout')->insert($rating);

        sleep(1);
        $this->closeModal();
    }
}
