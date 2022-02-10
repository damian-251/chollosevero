<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        //Así al ejecutar 'php artisan db:seed' se ejecutarán todos los seeder
        $this->call([CholloSeeder::class, CategoriaSeeder::class]);
        //\App\Models\User::factory(10)->create();
    }
}
