<?php

namespace Database\Seeders;

use App\Models\Scout;
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
        $users = [];

        $users[] = [
            'name' => 'Admin',
            'email' => 'admin@dev.com',
            'role' => 'admin',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];

        $users[] = [
            'name' => 'Alberto Valido Sánchez',
            'email' => 'losVelez@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];

        $users[] = [
            'name' => 'Airam Mujica López',
            'email' => 'doramas@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Street Canarias Pres',
            'email' => 'streetCanarias@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Goleta Sub23 Pres',
            'email' => 'goleta@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Aregranca Pres',
            'email' => 'aregranca@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Talleres Canary Pres',
            'email' => 'talleresCanary@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Siete Palmas Pres',
            'email' => 'sietePalmas@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Almenara',
            'email' => 'almenara@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Abrisajac Pres',
            'email' => 'abrisajac@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'San Pedro Pres',
            'email' => 'sanPedro@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Sardina Pres',
            'email' => 'sardina@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Barrio Atlántico Pres',
            'email' => 'barrioAtlantico@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Telde Pres',
            'email' => 'telde@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Mogán Pres',
            'email' => 'mogan@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'La Garita Pres',
            'email' => 'laGarita@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Real Sporting Pres',
            'email' => 'realSporting@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Firgas Pres',
            'email' => 'firgas@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Pedro Hidalgo Pres',
            'email' => 'poedroHidalgo@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Guiniguada Pres',
            'email' => 'guiniguada@gmail.com',
            'role' => 'president',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];
        $users[] = [
            'name' => 'Javi Apuntador Sánchez ',
            'email' => 'apuntador@gmail.com',
            'role' => 'prompter',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => asset('assets/images/no_photo.png'),
        ];

        for ($i = 1; $i < 11; $i++) {
            $users[] = [
                'name' => 'Ojeador ' . $i,
                'email' => 'ojeador' . $i . '@gmail.com',
                'role' => 'scout',
                'password' => bcrypt('1234'),
                'created_at' => now(),
                'updated_at' => now(),
                'image' => asset('assets/images/no_photo.png'),
            ];
        }

        User::insert($users);
        User::factory()->count(20)->create();
    }
}
