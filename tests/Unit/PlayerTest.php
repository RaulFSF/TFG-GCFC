<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function player_has_expected_table()
    {
        $this->assertTrue(
            Schema::hasTable('players')
        );
    }

    /** @test */
    public function player_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('players', ['id', 'user_id', 'category_id', 'team_id', 'image', 'birthdate', 'name', 'email'])
        );
    }

    /** @test */
    public function player_can_be_created()
    {
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'prueba@dev.com',
            'role' => 'player',
            'password' => Hash::make('123456789'),
        ]);

        $administrator = User::create([
            'name' => 'Pres 1',
            'email' => 'pres1@dev.com',
            'role' => 'president',
            'password' => Hash::make('123456789'),
        ]);

        $team = Team::create([
            'name' => 'Equipo Prueba',
            'administrator_id' => $administrator->id,
            'shield' => 'teams/losVelez.png',
            'field' => [ "name" => "Campo de Futbol de prueba", "address" => "https:\/\/goo.gl\/maps\/dzYow9C9yVWjYU1N9"],
            'description' => 'Descripción de prueba',
        ]);

        $categoryType = CategoryType::create([
            'name' => 'benjamin',
        ]);

        $category = Category::create([
            'team_id' => $team->id,
            'category_type_id' => $categoryType->id,
        ]);

        $player = Player::create([
            'name' => 'Jugador de prueba',
            'email' => 'pruebaJugador@dev.com',
            'user_id' => $user->id,
            'category_id' => $category->id,
            'team_id' => $team->id,
            'birthdate' => Carbon::now()->subYears(9),
        ]);

        $this->assertModelExists($player);
    }

    /** @test */
    public function player_can_be_deleted()
    {
        $user = User::create([
            'name' => 'Prueba',
            'email' => 'prueba@dev.com',
            'role' => 'player',
            'password' => Hash::make('123456789'),
        ]);

        $administrator = User::create([
            'name' => 'Pres 1',
            'email' => 'pres1@dev.com',
            'role' => 'president',
            'password' => Hash::make('123456789'),
        ]);

        $team = Team::create([
            'name' => 'Equipo Prueba',
            'administrator_id' => $administrator->id,
            'shield' => 'teams/losVelez.png',
            'field' => [ "name" => "Campo de Futbol de prueba", "address" => "https:\/\/goo.gl\/maps\/dzYow9C9yVWjYU1N9"],
            'description' => 'Descripción de prueba',
        ]);

        $categoryType = CategoryType::create([
            'name' => 'benjamin',
        ]);

        $category = Category::create([
            'team_id' => $team->id,
            'category_type_id' => $categoryType->id,
        ]);

        $player = Player::create([
            'name' => 'Jugador de prueba',
            'email' => 'pruebaJugador@dev.com',
            'user_id' => $user->id,
            'category_id' => $category->id,
            'team_id' => $team->id,
            'birthdate' => Carbon::now()->subYears(9),
        ]);

        $player->delete();
        $this->assertModelMissing($player);
    }
}
