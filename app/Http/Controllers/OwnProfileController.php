<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayerHistory;
use App\Models\Scout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnProfileController extends Controller
{
    public $follows;
    public $ratings;
    public $scout;
    public $player;

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
        $this->scout = Scout::where('user_id', auth()->id())->first();

        if (auth()->user()->role === 'scout') {
            $this->follows = DB::table('player_follow')->where('scout_id', $this->scout->id)->count();
            $this->ratings = DB::table('player_scout')->where('scout_id', $this->scout->id)->orderByDesc('date')->get();
        }
        return view('profile', [
            'user' => auth()->user(),
            'follows' => $this->follows,
            'ratings_count' => $this->ratings->count(),
            'ratings' => $this->ratings,
        ]);
    }

    public function showPlayer($id)
    {
        $this->player = Player::where('id', $id)->firstOrFail();
        $histories = PlayerHistory::where('player_id', $id)->orderByDesc('updated_at')->get();
        $ratings = DB::table('player_scout')->where('player_id', $this->player->id)->orderByDesc('date')->get();

        return view('player-profile',[
            'player' => $this->player,
            'histories' => $histories,
            'ratings' => $ratings,
        ]);
    }
}
