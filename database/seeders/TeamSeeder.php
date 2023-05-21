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
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/losVelez.png',
            'field' => ["name" => "Campo de Fútbol Montaña los Velez", "address" => "https://goo.gl/maps/dzYow9C9yVWjYU1N9"],
        ]);

        Team::create([
            'administrator_id' => 3,
            'name' => 'Doramas',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/doramas.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 4,
            'name' => 'Street Canarias',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/streetCanarias.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 5,
            'name' => 'Goleta Sub23',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/goletaSub23.png',
            'field' => ["name" => "Campo de Fútbol Montaña los Velez", "address" => "https://goo.gl/maps/dzYow9C9yVWjYU1N9"]
        ]);

        Team::create([
            'administrator_id' => 6,
            'name' => 'Aregranca',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/aregranca.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 7,
            'name' => 'Talleres Canary',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/talleresCanary.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 8,
            'name' => 'Siete Palmas',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/sietePalmas.png',
            'field' => ["name" => "Campo de Fútbol Montaña los Velez", "address" => "https://goo.gl/maps/dzYow9C9yVWjYU1N9"]
        ]);

        Team::create([
            'administrator_id' => 9,
            'name' => 'Almenara',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/almenara.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 10,
            'name' => 'Abrisajac',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/abrisajac.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 11,
            'name' => 'San Pedro',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/sanPedro.png',
            'field' => ["name" => "Campo de Fútbol Montaña los Velez", "address" => "https://goo.gl/maps/dzYow9C9yVWjYU1N9"]
        ]);

        Team::create([
            'administrator_id' => 12,
            'name' => 'Sardina',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/sardina.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 13,
            'name' => 'Barrio Atlántico',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/barrioAtlantico.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 14,
            'name' => 'Telde',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/telde.png',
            'field' => ["name" => "Campo de Fútbol Montaña los Velez", "address" => "https://goo.gl/maps/dzYow9C9yVWjYU1N9"]
        ]);

        Team::create([
            'administrator_id' => 15,
            'name' => 'Mogán',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/mogan.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 16,
            'name' => 'La Garita',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/laGarita.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 17,
            'name' => 'Real Sporting',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/realSporting.png',
            'field' => ["name" => "Campo de Fútbol Montaña los Velez", "address" => "https://goo.gl/maps/dzYow9C9yVWjYU1N9"]
        ]);

        Team::create([
            'administrator_id' => 18,
            'name' => 'Firgas',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/firgas.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 19,
            'name' => 'Pedro Hidalgo',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/pedroHidalgo.png',
            'field' => ["name" => "Ciudad Deportiva Municipal del Cruce de Arinaga", "address" => "https://goo.gl/maps/fcy8M5iQpK2ZU8sP8"]
        ]);

        Team::create([
            'administrator_id' => 20,
            'name' => 'Guiniguada',
            'description' => fake()->paragraphs($nb = 4, $asText = true),
            'shield' => 'teams/guiniguada.png',
            'field' => ["name" => "Campo de Fútbol Montaña los Velez", "address" => "https://goo.gl/maps/dzYow9C9yVWjYU1N9"]
        ]);
    }
}
