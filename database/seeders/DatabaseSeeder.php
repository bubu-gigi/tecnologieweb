<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProdottiSeeder::class,
            MalfunzionamentiSeeder::class,
            CentriAssistenzaSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
