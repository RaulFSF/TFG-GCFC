<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Scout;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $first = $teams->first();
        $user = User::create([
            'name' => 'Raúl Sánchez Falcón',
            'email' => 'raulPrueba@gmail.com',
            'role' => 'player',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ]);

        Player::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'team_id' => $first->id,
            'category_id' => $first->categories->first()->id,
            'birthdate' => fake()->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ]);

        $players = [];
        foreach ($teams as $team) {
            foreach ($team->categories as $category) {
                for ($i = 1; $i <= random_int(16, 24); $i++) {
                    $players[] = [
                        'name' => fake()->name(),
                        'email' => fake()->unique()->safeEmail(),
                        'team_id' => $category->team->id,
                        'category_id' => $category->id,
                        'birthdate' => fake()->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d'),
                        'created_at' => now(),
                        'updated_at' => now(),
                        'image' => asset('assets/images/no_photo.png'),
                    ];
                }
            }
        }
        Player::insert($players);
    }
}
