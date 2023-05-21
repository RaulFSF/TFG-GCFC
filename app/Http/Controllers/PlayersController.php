<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayersController extends Controller
{

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
        return view('players', [
            'seasonAvailable' => Season::get()->count() > 0,
        ]);
    }
}
