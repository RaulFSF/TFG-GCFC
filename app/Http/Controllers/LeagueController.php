<?php

namespace App\Http\Controllers;

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
        ]);
    }

    public function showLeague($league)
    {
        $this->league = $league;
        return view('league', [
            'league_id' => $this->league,
        ]);
    }
}
