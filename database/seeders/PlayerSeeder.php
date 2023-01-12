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
        $teamsCount = Team::all()->count();
        Player::create([
            'name' => 'Paco Sánchez Falcón',
            'email' => 'paco@gmail.com',
            'team_id' => random_int(1, $teamsCount),
        ]);
        Player::create([
            'name' => 'David Sánchez Falcón',
            'email' => 'david@gmail.com',
            'team_id' => random_int(1, $teamsCount),
        ]);
        Player::factory()->count(10)->create();
    }
}
