<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('productos')->insert([
                'nombre' => $faker->word,
                'imagen' => $faker->imageUrl($width = 640, $height = 480), // Puedes usar un URL falso para imágenes
                'descripcion' => $faker->sentence,
                'categoria_id' => $faker->randomElement([1, 2]),
                'proovedor_id' => $faker->randomElement([1, 2]),
                'precio_compra' => $faker->randomFloat(2, 1, 100),
                'precio_venta' => $faker->randomFloat(2, 1, 100),
                'cantidad_stock' => $faker->numberBetween(1, 100),
                'unidad' => $faker->randomElement(['Botella', 'Jarra', 'Vaso']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
