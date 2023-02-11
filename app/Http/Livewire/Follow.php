<?php

namespace App\Http\Livewire;

use App\Models\Scout;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Follow extends Component
{
    public $player_id;
    public $scout;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->scout = Scout::where('user_id', auth()->id())->first();
    }

    public function render()
    {
        return view('livewire.follow');
    }

    public function follow()
    {
        sleep(0.5);
        $record = [
            'scout_id' => $this->scout->id,
            'player_id' => $this->player_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('player_follow')->insert($record);

        $this->emit('refresh');
    }

    public function unfollow()
    {
        sleep(0.5);
        DB::table('player_follow')->where('player_id', $this->player_id)->where('scout_id', $this->scout->id)->delete();

        $this->emit('refresh');
    }

    public function isFollowed()
    {
        $record = DB::table('player_follow')->where('scout_id', $this->scout->id)->where('player_id', $this->player_id)->first();
        if($record){
            return true;
        }
        return false;
    }

}
