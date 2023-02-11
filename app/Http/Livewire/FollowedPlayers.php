<?php

namespace App\Http\Livewire;

use App\Models\PlayerHistory;
use App\Models\Scout;
use App\Models\Season;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Component;

class FollowedPlayers extends Component
{
    use WithPagination;

    public $scout;
    public $followed;
    public $activeLeagues;
    public $search;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {

    }

    public function render()
    {
        $this->scout = Scout::where('user_id', auth()->id())->first();
        $this->followed = DB::table('player_follow')->where('scout_id', $this->scout->id)->get()->pluck('player_id');
        $this->activeLeagues = Season::orderByDesc('start_date')->first()->leagues()->pluck('id');

        return view('livewire.followed-players', [
            'players' =>  PlayerHistory::whereIn('player_id', $this->followed)->whereIn('league_id', $this->activeLeagues)->whereHas('player', function($query){
                $query->where('name', 'like', '%'.$this->search.'%');
            })->paginate(10),
        ]);
    }

    public function unfollow($history)
    {
        sleep(0.5);
        DB::table('player_follow')->where('player_id', $history['player_id'])->where('scout_id', $this->scout->id)->delete();

        $this->emit('refresh');
    }

    public function isFollowed($history)
    {
        $record = DB::table('player_follow')->where('scout_id', $this->scout->id)->where('player_id', $history['player_id'])->first();
        if($record){
            return true;
        }
        return false;
    }
}
