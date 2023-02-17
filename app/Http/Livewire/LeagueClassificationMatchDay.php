<?php

namespace App\Http\Livewire;

use App\Models\Classification;
use App\Models\League;
use App\Models\MatchDay;
use App\Models\Season;
use Carbon\Carbon;
use Livewire\Component;

class LeagueClassificationMatchDay extends Component
{
    public $options;
    public $search;
    public $league_teams;
    public $league_id;

    public $category_matches;
    public $options_matchDays;
    public $searchMatchDay;
    public $actual_matchDays;

    public function mount($league_id)
    {
        $this->options = League::whereIn('season_id', Season::where('end_date', '>', Carbon::now())->select('id')->first()->toArray())->get();

        if ($this->league_id != -1) {
            $this->search = $this->league_id;
        } else {
            $this->search = $this->options->first()->id;
        }

        $this->league_teams = Classification::where('league_id', $this->search)->orderByDesc('points')->orderByDesc('wins')->orderByDesc('goals_scored')->orderBy('goals_against')->get();

        $this->options_matchDays = MatchDay::where('league_id', $this->search)->with('categoryMatches')->orderBy('number')->get();

        $this->actual_matchDays = MatchDay::where('date', '>=', Carbon::today())->groupBy('league_id')->get()->pluck('id', 'league_id')->toArray();

        $this->category_matches = $this->options_matchDays->first();
    }

    public function render()
    {
        $i = 0;
        foreach ($this->options_matchDays as $option) {
            if ($option->id == $this->actual_matchDays[$this->search]) {
                $this->options_matchDays->forget($i);
                $this->options_matchDays->prepend($option);
            }
            ++$i;
        }
        $this->category_matches = $this->options_matchDays->first();
        return view('livewire.league-classification-match-day');
    }

    public function searchLeague()
    {
        sleep(0.5);
        if ($this->search != -1) {
            $this->league_teams = Classification::where('league_id', $this->search)->orderByDesc('points')->orderByDesc('wins')->orderByDesc('goals_scored')->orderBy('goals_against')->get();
            $this->options_matchDays = MatchDay::where('league_id', $this->search)->with('categoryMatches')->orderBy('number')->get();
        } else {
            $this->league_teams = Classification::where('league_id', 1)->orderByDesc('points')->orderByDesc('wins')->orderByDesc('goals_scored')->orderBy('goals_against')->get();
            $this->options_matchDays = MatchDay::where('league_id', 1)->with('categoryMatches')->orderBy('number')->get();
        }
    }

    public function searchMatchDay()
    {
        sleep(0.5);
        $this->category_matches = $this->options_matchDays->where('id', $this->searchMatchDay)->first();
    }
}
