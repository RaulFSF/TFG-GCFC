<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@dev.com',
            'role' => 'admin',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Alberto Valido Sánchez',
            'email' => 'test1@dev.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Airam Mujica López',
            'email' => 'test2@dev.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Adrian Santana Santana',
            'email' => 'prueba@gmail.com',
            'role' => 'player',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Javi Apuntador Sánchez ',
            'email' => 'apuntador@dev.com',
            'role' => 'prompter',
            'password' => bcrypt('1234'),
        ]);
       // Crea usuarios rol coach pero no hay funcionalidades para coach aún
        // User::coach(2);

    }
}
