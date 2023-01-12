<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $teamsCount = Team::all()->count();
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'team_id' => random_int(1, $teamsCount),
        ];
    }
}
