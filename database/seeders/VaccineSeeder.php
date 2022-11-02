<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vaccine;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vaccine::create([
            'name' => 'Hepatitis B',
            'description' => 'Hepatitis B, primera 24 horas del recién nacido, solo una dosis.',
            'stock' => 20,
            'alerts' => 5,
            'status' => 1,
            'category_id' => 3
        ]);
        Vaccine::create([
            'name' => 'BCG',
            'description' => 'Tuberculosis, se pone en los primeros 28 días del recién nacido.',
            'stock' => 20,
            'alerts' => 5,
            'status' => 1,
            'category_id' => 2
        ]);
        Vaccine::create([
            'name' => 'Rotavirus',
            'description' => 'Previene la diarrea severa por rotavirus, se coloca en el 2º y 4º mes del recié nacido.',
            'stock' => 20,
            'alerts' => 5,
            'status' => 1,
            'category_id' => 1
        ]);
    }
}
