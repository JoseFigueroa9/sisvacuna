<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            'name' => 'Steve Andres',
            'lastname' => 'Ramirez Nolasco',
            'dni' => 85245673,
            'phone' => '958264125',
            'email' => 'stefanynolasco@gmail.com',
            'status' => 'ACTIVE',
            'father_fullname' => 'Pedro Ramirez Rojas',
            'mother_fullname' => 'Stefany Nolasco Estrada',
            'father_dni' => 65842351,
            'mother_dni' => 69495203,
            'gender' => 'M'
        ]);
        Patient::create([
            'name' => 'Kevin',
            'lastname' => 'Donaire Prada',
            'dni' => 84565248,
            'phone' => '996584711',
            'email' => 'ingrid58@gmail.com',
            'status' => 'ACTIVE',
            'father_fullname' => 'Ramiro Donaire Quispe',
            'mother_fullname' => 'Raquel Prada Palacios',
            'father_dni' => 65485497,
            'mother_dni' => 66923001,
            'gender' => 'M'
        ]);
        Patient::create([
            'name' => 'Marina Esther',
            'lastname' => 'Velasco Duque',
            'dni' => 81105247,
            'phone' => '997542110',
            'email' => 'esther12@gmail.com',
            'status' => 'ACTIVE',
            'father_fullname' => 'Jose Pablo Velasco Gonzales',
            'mother_fullname' => 'Esther Maria Duque Rios',
            'father_dni' => 63325142,
            'mother_dni' => 65788521,
            'gender' => 'F'
        ]);
    }
}
