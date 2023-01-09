<?php

namespace Database\Seeders;

use App\Models\Category;
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
        Category::create([
            'team_id' => 1,
            'category_type_id' => 1,
        ]);
        Category::create([
            'team_id' => 1,
            'category_type_id' => 2,
        ]);
        Category::create([
            'team_id' => 2,
            'category_type_id' => 2,
        ]);
    }
}
