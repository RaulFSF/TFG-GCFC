<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'administrator_id' => 2,
            'name' => 'Montaña Los Vélez',
            'description' => 'Equipo 1',
            'shield' => 'yYKj0BnmTywXxtHZ6LyYd7llTjA3dB-metaRm90byBjYXJuZXQucG5n-.png',
        ]);

        Team::create([
            'administrator_id' => 3,
            'name' => 'Doramas',
            'description' => 'Equipo 2',
            'shield' => 'yYKj0BnmTywXxtHZ6LyYd7llTjA3dB-metaRm90byBjYXJuZXQucG5n-.png',
        ]);

    }
}
