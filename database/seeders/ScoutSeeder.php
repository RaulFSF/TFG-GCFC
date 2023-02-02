<?php

namespace Database\Seeders;

use App\Models\Scout;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scouts = [];
        foreach(User::where('role', 'scout')->get() as $user){
            $scouts[] = [
                'user_id' => $user->id,
            ];
        };
        Scout::insert($scouts);
    }
}
