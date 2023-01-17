<?php

namespace Database\Seeders;

use App\Models\Prompter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrompterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prompters = User::where('role', 'prompter')->get();
        foreach($prompters as $prompter){
            Prompter::create([
                'user_id' => $prompter->id,
            ]);
        };
    }
}
