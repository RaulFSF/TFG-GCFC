<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Scout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowPlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scouts = Scout::all();

        $result = [];
        foreach($scouts as $scout){
            foreach(Player::inRandomOrder()->limit(4)->get() as $player){
                $result[] = [
                    'player_id' => $player->id,
                    'scout_id' => $scout->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('player_follow')->insert($result);
    }
}
