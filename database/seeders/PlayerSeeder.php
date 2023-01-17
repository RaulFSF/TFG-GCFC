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
        $teams = Team::all();
        foreach ($teams as $team) {
            foreach ($team->categories as $category) {

                for($i = 1; $i <= random_int(16,24); $i++){
                    Player::create([
                        'name' => fake()->name(),
                        'email' => fake()->unique()->safeEmail(),
                        'team_id' => $category->team->id,
                        'category_id' => $category->id,
                        'birthdate' => fake()->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d'),
                    ]);
                }
            }
        }
    }
}
