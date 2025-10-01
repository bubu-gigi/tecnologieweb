<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chiama i seeders che vuoi eseguire
        $this->call([
            ProdottiSeeder::class,
            // altri seeder eventualmente
        ]);
    }
}
