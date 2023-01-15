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
            'shield' => 'NBQl6gFQCy2pvDd8Ro5oZdwZ7G13du-metabG9zVmVsZXoucG5n-.png',
            'field' => json_decode('[{"name" : "Campo de Fútbol Montaña los Velez", "address" : "https://goo.gl/maps/dzYow9C9yVWjYU1N9"}]'),
        ]);

        Team::create([
            'administrator_id' => 3,
            'name' => 'Doramas',
            'description' => 'Equipo 2',
            'shield' => 'JF4nAeApRcX97nB6W0rcFrFoEtRzrO-metaMTAweDEwMGRvcmFtYXMucG5n-.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

    }
}
