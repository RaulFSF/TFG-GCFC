<?php

namespace Tests\Unit;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function team_has_expected_table()
    {
        $this->assertTrue(
            Schema::hasTable('teams')
        );
    }

    /** @test */
    public function team_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('teams', ['id', 'administrator_id', 'name', 'shield', 'field', 'description'])
        );
    }

    /** @test */
    public function team_can_be_created()
    {
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

        $this->assertModelExists($team);
    }

    /** @test */
    public function team_can_be_deleted()
    {
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

        $team->delete();
        $this->assertModelMissing($team);
    }
}
