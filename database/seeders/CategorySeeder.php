<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\League;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::all();
        $categoryType = CategoryType::all();
        foreach($categoryType as $category){
            foreach($teams as $team){
                Category::create([
                    'league_id' => League::where('category_type_id', $category->id)->first()->id,
                    'team_id' => $team->id,
                    'category_type_id' => $category->id,
                ]);
            }
        }
    }
}
