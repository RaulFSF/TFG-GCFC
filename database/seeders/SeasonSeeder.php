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
            'start_date' => Carbon::createFromFormat('Y-m-d', '2021-09-08')->toDateString(),
            'end_date' => Carbon::createFromFormat('Y-m-d', '2022-06-20')->toDateString(),
        ]);

        Season::create([
            'name' => 'Temporada 22/23',
            'start_date' => Carbon::createFromFormat('Y-m-d', '2022-09-10')->toDateString(),
            'end_date' => Carbon::createFromFormat('Y-m-d', '2023-07-10')->toDateString(),
        ]);
    }
}
