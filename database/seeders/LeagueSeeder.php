<?php

namespace Database\Seeders;

use App\Models\CategoryType;
use App\Models\League;
use Carbon\Carbon;
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
        $category_types = CategoryType::all();
        foreach($category_types as $category_type){
            League::create([
                'name' => 'Liga ' . $category_type->name,
                'category_type_id' => $category_type->id,
                'season' => '2023/2024',
                'start_date' => Carbon::now()->addMonth(1)->toDate(),
            ]);
        }
    }
}
