<?php

namespace App\Http\Livewire;

use App\Models\League;
use App\Models\Player;
use App\Models\PlayerHistory;
use App\Models\Scout;
use App\Models\Season;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FollowedPlayers extends Component
{
    public $scout;
    public $followed;
    public $activeLeagues;
    public $search;

    public function mount()
    {
        $this->scout = Scout::where('user_id', auth()->id())->first();
        $this->followed = DB::table('player_follow')->where('scout_id', $this->scout->id)->get()->pluck('player_id');
        $this->activeLeagues = Season::orderByDesc('start_date')->first()->leagues()->pluck('id');
    }

    public function render()
    {
        return view('livewire.followed-players', [
            'players' =>  PlayerHistory::whereIn('player_id', $this->followed)->whereIn('league_id', $this->activeLeagues)->whereHas('player', function($query){
                $query->where('name', 'like', '%'.$this->search.'%');
            })->paginate(10),
        ]);
    }
}
