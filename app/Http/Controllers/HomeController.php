<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('welcome', [
            'showLeague' => Season::where('end_date', '>', Carbon::now())->first() ? true : false,
        ]);
    }
}
