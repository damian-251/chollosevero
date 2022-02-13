<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()   {

        $categorias = ['videojuegos', 'viajes', 'alimentacion', 'comida', 'informatica', 'transporte', 'conduccion', 'salud', 'belleza'];

        foreach ($categorias as $categoria) {
            $categoria = new Categoria();
            $categoria->nombre = $categoria;
            $categoria->save();
        }

        //
    }
}
