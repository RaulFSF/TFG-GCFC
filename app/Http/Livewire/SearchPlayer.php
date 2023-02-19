<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Player;
use App\Models\PlayerHistory;
use App\Models\Scout;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SearchPlayer extends Component
{
    use WithPagination;

    public $scout;
    public $activeLeagues;
    public $search;
    public $team_id;
    public $is_team_profile = false;
    public $categoryOptions;
    public $teamOptions;
    public $categoryFilter;
    public $teamFilter;

    public $tableType = 'history';

    public $sortField;
    public $sortDirection = 'asc';

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->categoryFilter = -1;
        $this->teamFilter = -1;
        $this->categoryOptions = CategoryType::orderByDesc('id')->get();
        $this->teamOptions = Team::all();
        $this->scout = Scout::where('user_id', auth()->id())->first();
        $this->activeLeagues = Season::orderByDesc('start_date')->first()->leagues()->pluck('id');
    }

    public function render()
    {
        if ($this->team_id) {
            $this->is_team_profile = true;
            $categories = Category::where('team_id', $this->team_id)->get()->pluck('id')->toArray();

            if ($this->categoryFilter != -1) {
                $actual_query = PlayerHistory::whereIn('league_id', $this->activeLeagues)->whereIn('category_id', $categories)->whereHas('player.category.categoryType', function ($query) {
                    $query->where('id', $this->categoryFilter);
                });
            } else {
                $actual_query = PlayerHistory::whereIn('league_id', $this->activeLeagues)->whereIn('category_id', $categories);
            }
            return view('livewire.search-player', [
                'players' =>  $actual_query->whereHas('player', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })->orderBy($this->sortField, $this->sortDirection)->paginate(10),
            ]);
        } else {
            if ($this->categoryFilter != -1 && $this->teamFilter != -1) {
                $actual_query = PlayerHistory::whereIn('league_id', $this->activeLeagues)->whereHas('player.category.categoryType', function ($query) {
                    $query->where('id', $this->categoryFilter);
                })->whereHas('player.category.team', function ($query) {
                    $query->where('id', $this->teamFilter);
                });
            } else if ($this->categoryFilter != -1 && $this->teamFilter == -1) {
                $actual_query = PlayerHistory::whereIn('league_id', $this->activeLeagues)->whereHas('player.category.categoryType', function ($query) {
                    $query->where('id', $this->categoryFilter);
                });
            } else if ($this->categoryFilter == -1 && $this->teamFilter != -1) {
                $actual_query = PlayerHistory::whereIn('league_id', $this->activeLeagues)->whereHas('player.category.team', function ($query) {
                    $query->where('id', $this->teamFilter);
                });
            } else {
                $actual_query = PlayerHistory::whereIn('league_id', $this->activeLeagues);
            }
            return view('livewire.search-player', [
                'players' =>  $actual_query->whereHas('player', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })->orderBy($this->sortField, $this->sortDirection)->paginate(10),
            ]);
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function updatingTableType()
    {
        $this->emit('refresh');
    }


    public function filterByCategory()
    {
        sleep(0.5);
    }

    public function filterByTeam()
    {
        sleep(0.5);
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
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
        if ($record) {
            return true;
        }
        return false;
    }
}
