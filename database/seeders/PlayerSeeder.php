<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = User::where('role', 'player')->get()->toArray();
        $teamsCount = Team::all()->count();
        foreach($players as $player){
            Player::create([
                'user_id' => $player['id'],
                'team_id' => random_int(1, $teamsCount),
            ]);
        }
    }
}
