<?php

namespace Database\Seeders;

use App\Models\League;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        League::create([
            'name' => 'Benjamín',
            'category_type_id' => 1,
            'season' => '2023/2024',
        ]);

        League::create([
            'name' => 'Alevín',
            'category_type_id' => 2,
            'season' => '2023/2024',
        ]);
    }
}
