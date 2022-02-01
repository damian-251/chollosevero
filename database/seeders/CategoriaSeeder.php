<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()   {

        $categorias = ['videojuegos', 'viajes', 'alimentacion', 'comida', 'informatica'];


        foreach ($categorias as $categoria) {
            $id = DB::table('categorias')->insertGetId([
                'nombre' => $categoria,
                'created_at' => date('Y-m-d H:i:s')]);
        }

        //
    }
}
