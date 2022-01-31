<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class CholloSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $numeroCampos = 20;

        for ($i = 0 ; $i < $numeroCampos ; $i++) {

            $faker = \Faker\Factory::create();
            
            $id = DB::table('chollos')->insertGetId([
            'titulo' => $faker->sentence(),
            'descripcion' => $faker->paragraph(),
            'url' => $faker->url(),
            'precio' => $faker->randomFloat(2, 0, 500),
            'precio_descuento' => $faker->randomFloat(2, 20, 500),
            'categoria' => $faker->word(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
            //Generamos una imagen por defecto para el chollo

            $image_name = $id . "-chollo-severo.jpg";
            $path = public_path() . '/assets/images';
            $imagen = $faker->image($path, 640, 480, 'chollo');
            rename($imagen, public_path() . '/assets/images/' . $image_name);
        }

        

    }
}
