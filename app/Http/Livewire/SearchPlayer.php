<?php

namespace App\Http\Livewire;

use App\Models\PlayerHistory;
use App\Models\Scout;
use App\Models\Season;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SearchPlayer extends Component
{
    use WithPagination;

    public $scout;
    public $activeLeagues;
    public $search;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->scout = Scout::where('user_id', auth()->id())->first();
        $this->activeLeagues = Season::orderByDesc('start_date')->first()->leagues()->pluck('id');
    }

    public function render()
    {
        return view('livewire.search-player', [
            'players' =>  PlayerHistory::whereIn('league_id', $this->activeLeagues)->whereHas('player', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->paginate(10),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function follow($history)
    {
        sleep(0.5);
        $record = [
            'scout_id' => $this->scout->id,
            'player_id' => $history['player_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('player_follow')->insert($record);

        $this->emit('refresh');
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
