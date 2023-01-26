<?php

namespace Database\Seeders;

use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Season::create([
            'name' => 'Temporada 21/22',
            'start_date' => Carbon::createFromFormat('Y-m-d', '2021-09-08'),
            'end_date' => Carbon::createFromFormat('Y-m-d', '2022-06-20'),
        ]);

        Season::create([
            'name' => 'Temporada 22/23',
            'start_date' => Carbon::createFromFormat('Y-m-d', '2022-09-05'),
            'end_date' => Carbon::createFromFormat('Y-m-d', '2023-06-10'),
        ]);
    }
}
