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
            'email' => 'losVelez@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Airam Mujica López',
            'email' => 'doramas@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Street Canarias Pres',
            'email' => 'streetCanarias@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Goleta Sub23 Pres',
            'email' => 'goleta@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Aregranca Pres',
            'email' => 'aregranca@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Talleres Canary Pres',
            'email' => 'talleresCanary@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Siete Palmas Pres',
            'email' => 'sietePalmas@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Almenara',
            'email' => 'almenara@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Abrisajac Pres',
            'email' => 'abrisajac@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'San Pedro Pres',
            'email' => 'sanPedro@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Sardina Pres',
            'email' => 'sardina@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Barrio Atlántico Pres',
            'email' => 'barrioAtlantico@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Telde Pres',
            'email' => 'telde@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Mogán Pres',
            'email' => 'mogan@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'La Garita Pres',
            'email' => 'laGarita@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Real Sporting Pres',
            'email' => 'realSporting@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Firgas Pres',
            'email' => 'firgas@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        User::create([
            'name' => 'Pedro Hidalgo Pres',
            'email' => 'poedroHidalgo@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
        // User::create([
        //     'name' => 'Guiniguada Pres',
        //     'email' => 'guiniguada@gmail.com',
        //     'role' => 'president',
        //     'password' => bcrypt('1234'),
        // ]);
        User::create([
            'name' => 'Javi Apuntador Sánchez ',
            'email' => 'apuntador@gmail.com',
            'role' => 'prompter',
            'password' => bcrypt('1234'),
        ]);
        User::factory()->count(20)->create();

        User::create([
            'name' => 'Prueba Valido Sánchez',
            'email' => 'velez@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
        ]);
    }
}
