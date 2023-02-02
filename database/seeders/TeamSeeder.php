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
            'shield' => 'teams/losVelez.png',
            'field' => json_decode('[{"name" : "Campo de Fútbol Montaña los Velez", "address" : "https://goo.gl/maps/dzYow9C9yVWjYU1N9"}]'),
        ]);

        Team::create([
            'administrator_id' => 3,
            'name' => 'Doramas',
            'description' => 'Equipo 2',
            'shield' => 'teams/doramas.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 4,
            'name' => 'Street Canarias',
            'description' => 'Equipo 3',
            'shield' => 'teams/streetCanarias.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 5,
            'name' => 'Goleta Sub23',
            'description' => 'Equipo 4',
            'shield' => 'teams/goletaSub23.png',
            'field' => json_decode('[{"name" : "Campo de Fútbol Montaña los Velez", "address" : "https://goo.gl/maps/dzYow9C9yVWjYU1N9"}]'),
        ]);

        Team::create([
            'administrator_id' => 6,
            'name' => 'Aregranca',
            'description' => 'Equipo 5',
            'shield' => 'teams/aregranca.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 7,
            'name' => 'Talleres Canary',
            'description' => 'Equipo 6',
            'shield' => 'teams/talleresCanary.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 8,
            'name' => 'Siete Palmas',
            'description' => 'Equipo 7',
            'shield' => 'teams/sietePalmas.png',
            'field' => json_decode('[{"name" : "Campo de Fútbol Montaña los Velez", "address" : "https://goo.gl/maps/dzYow9C9yVWjYU1N9"}]'),
        ]);

        Team::create([
            'administrator_id' => 9,
            'name' => 'Almenara',
            'description' => 'Equipo 8',
            'shield' => 'teams/almenara.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 10,
            'name' => 'Abrisajac',
            'description' => 'Equipo 9',
            'shield' => 'teams/abrisajac.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 11,
            'name' => 'San Pedro',
            'description' => 'Equipo 10',
            'shield' => 'teams/sanPedro.png',
            'field' => json_decode('[{"name" : "Campo de Fútbol Montaña los Velez", "address" : "https://goo.gl/maps/dzYow9C9yVWjYU1N9"}]'),
        ]);

        Team::create([
            'administrator_id' => 12,
            'name' => 'Sardina',
            'description' => 'Equipo 11',
            'shield' => 'teams/sardina.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 13,
            'name' => 'Barrio Atlántico',
            'description' => 'Equipo 12',
            'shield' => 'teams/barrioAtlantico.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 14,
            'name' => 'Telde',
            'description' => 'Equipo 13',
            'shield' => 'teams/telde.png',
            'field' => json_decode('[{"name" : "Campo de Fútbol Montaña los Velez", "address" : "https://goo.gl/maps/dzYow9C9yVWjYU1N9"}]'),
        ]);

        Team::create([
            'administrator_id' => 15,
            'name' => 'Mogán',
            'description' => 'Equipo 14',
            'shield' => 'teams/mogan.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 16,
            'name' => 'La Garita',
            'description' => 'Equipo 15',
            'shield' => 'teams/laGarita.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 17,
            'name' => 'Real Sporting',
            'description' => 'Equipo 16',
            'shield' => 'teams/realSporting.png',
            'field' => json_decode('[{"name" : "Campo de Fútbol Montaña los Velez", "address" : "https://goo.gl/maps/dzYow9C9yVWjYU1N9"}]'),
        ]);

        Team::create([
            'administrator_id' => 18,
            'name' => 'Firgas',
            'description' => 'Equipo 17',
            'shield' => 'teams/firgas.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 19,
            'name' => 'Pedro Hidalgo',
            'description' => 'Equipo 18',
            'shield' => 'teams/pedroHidalgo.png',
            'field' => json_decode('[{"name" : "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" : "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"}]'),
        ]);

        Team::create([
            'administrator_id' => 20,
            'name' => 'Guiniguada',
            'description' => 'Equipo 19',
            'shield' => 'teams/guiniguada.png',
            'field' => json_decode('[{"name" : "Campo de Fútbol Montaña los Velez", "address" : "https://goo.gl/maps/dzYow9C9yVWjYU1N9"}]'),
        ]);
    }
}
