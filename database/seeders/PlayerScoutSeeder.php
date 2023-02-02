<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Scout;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerScoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $player_scouts = [];
        foreach (Player::all() as $player) {
            $scouts = Scout::inRandomOrder()->limit(4)->get();
            foreach ($scouts as $scout) {
                $player_scouts[] = [
                    'player_id' => $player->id,
                    'scout_id' => $scout->id,
                    'date' => Carbon::now()->subDays(rand(1, 55)),
                    'stars' => random_int(1, 5),
                    'comment' => fake()->sentence(),
                ];
            }
        }
        DB::table('player_scout')->insert($player_scouts);
    }
}
