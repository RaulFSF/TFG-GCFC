<?php

namespace Database\Seeders;

use App\Models\CategoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryType::create([
            'name' => 'Benjamín'
        ]);
        CategoryType::create([
            'name' => 'Alevín'
        ]);
    }
}
