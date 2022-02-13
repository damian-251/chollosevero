<?php

namespace Database\Seeders;

use App\Models\Chollo;
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
            $chollo = new Chollo();
            $chollo->titulo = $faker->sentence();
            $chollo->descripcion = $faker->paragraph();
            $chollo->url = $faker->url();
            $chollo->precio = $faker->randomFloat(2, 0, 500);
            $chollo->precio_descuento = $faker->randomFloat(2, 0, 500);
            $chollo->usuario_id = $faker->randomDigitNot(0);
            $chollo->save();
            $id = $chollo->id;

            $image_name = $id . "-chollo-severo.jpg";
            $path = public_path() . '/assets/images';
            $imagen = $faker->image($path, 640, 480, 'chollo');
            rename($imagen, public_path() . '/assets/images/' . $image_name);

            $numeroDeCategorias = $faker->numberBetween(1,3); //Entre 1 y 3 categorías

            for ($j = 0 ; $j < $numeroDeCategorias ; $j++) {
                //También hay que insertar en la tabla intermedia 
                Chollo::findOrFail($id)->categorias()->attach($faker->numberBetween(1,9));
                //Mejor hacerlo de esta forma que insertando con DB::Table ya que así se rellenan los timestamps
            }
            
        }

        

    }
}
