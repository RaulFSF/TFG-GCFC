<?php

namespace App\Http\Livewire;

use App\Models\League;
use App\Models\MatchDay;
use App\Models\Season;
use Carbon\Carbon;
use Livewire\Component;

class ListMatches extends Component
{
    public $matchDays;
    public $options;
    public $search;

    public function mount()
    {
        $this->matchDays = MatchDay::where('date', '>=', Carbon::today())->with('categoryMatches')->groupBy('league_id')->orderBy('date')->get();
        $this->options = League::whereIn('season_id', Season::where('end_date', '>', Carbon::now())->select('id')->first()->toArray())->get();
    }

    public function render()
    {
        return view('livewire.list-matches');
    }

    public function searchLeague()
    {
        sleep(1);
        if ($this->search != -1) {
            $this->matchDays = MatchDay::where('date', '>=', Carbon::today())->where('league_id', $this->search)->with('categoryMatches')->groupBy('league_id')->orderBy('date')->get();
        } else {
            $this->matchDays = MatchDay::where('date', '>=', Carbon::today())->with('categoryMatches')->groupBy('league_id')->orderBy('date')->get();
        }
    }
}
