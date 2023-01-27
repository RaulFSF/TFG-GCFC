<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\League;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        foreach ($categoryType as $category) {
            foreach ($teams as $team) {
                $new_category = Category::create([
                    'team_id' => $team->id,
                    'category_type_id' => $category->id,
                ]);
                foreach(Season::all() as $season){
                    DB::table('category_league')->insert(['league_id' => League::where('season_id', $season->id)->where('category_type_id', $category->id)->first()->id, 'category_id' => $new_category->id]);
                }
            }
        }
    }
}
