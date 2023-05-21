<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeagueController extends Controller
{

    public $league;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('league', [
            'league_id' => -1,
            'showLeague' => Season::where('end_date', '>', Carbon::now())->first() ? true : false,
        ]);
    }

    public function showLeague($league)
    {
        $this->league = $league;
        return view('league', [
            'league_id' => $this->league,
            'showLeague' => Season::where('end_date', '>', Carbon::now())->first() ? true : false,
        ]);
    }
}
