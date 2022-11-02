<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Vivas Atenuadas',
            'description' => 'Utilizan una forma debilitada del germen que causa una enfermedad. Similar a la infección natural que ayuda a prevenir, crean respuesta inmunitaria fuerte y de larga duración. Solo 1 o 2 dosis de la mayoría de vacunas vivas atenuadas puede protegerte durante toda la vida contra un germen y la enfermedad que la causa.'
        ]);
        Category::create([
            'name' => 'Inactivadas',
            'description' => 'Utilizan la versión muerta del germen que causa una enfermedad. No suelen proporcionar una inmunidad tan fuerte como las vacunas vivas. Es posible que necesite varias dosis con el tiempo para tener inmunidad continua contra las enfermedades.'
        ]);
        Category::create([
            'name' => 'Subunidades Recombinantes',
            'description' => 'Utilizan partes específicas del germen, como su proteína, azúcar o cápsula. Ofrecen una respuesta inmunitaria muy fuerte dirigida a las partes claves del germen. También se utilizan en cualquier persona que las necesite, incluso en personas con sistema inmune debilitado.'
        ]);
        Category::create([
            'name' => 'Toxoides',
            'description' => 'Utilizan una toxina fabricada a partir del germen que causa una enfermedad. Crean inmunidad a las partes del germen que causan enfermedad en lugar de al germen en sí. Es decir, su respuesta inmunitaria va dirigida a la toxina en lugar de a todo el germen.'
        ]);
    }
}
