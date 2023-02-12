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
        $types = ['Infantil', 'Cadete', 'Juvenil','Regional'];
        foreach($types as $type){
            CategoryType::create([
                'name' => $type,
            ]);
        }
    }
}
