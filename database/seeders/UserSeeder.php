<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
            'name' => 'Daniel',
            'lastname' => 'Vicente Ramos',
            'dni' => 75541205,
            'phone' => '998526321',
            'email' => 'danielramos@gmail.com',
            'password' => bcrypt('12345678'),
            'status' => 'ACTIVE',
            'profile' => 'ADMIN'
        ]);
        User::create([
            'name' => 'Melissa',
            'lastname' => 'Cáceres Robles',
            'dni' => 68857412,
            'phone' => '993225410',
            'email' => 'melirobles@gmail.com',
            'password' => bcrypt('12345678'),
            'status' => 'ACTIVE',
            'profile' => 'ENFERMERO'
        ]);
        User::create([
            'name' => 'Esteban',
            'lastname' => 'Palacios Vilchez',
            'dni' => 78452163,
            'phone' => '985447231',
            'email' => 'estebanvilchez@gmail.com',
            'password' => bcrypt('12345678'),
            'status' => 'ACTIVE',
            'profile' => 'ASISTENTE'
        ]);
    }
}
