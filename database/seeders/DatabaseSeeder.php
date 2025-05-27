<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DipartimentoSeeder::class,
            MedicoSeeder::class,
            PrestazioneSeeder::class,
            UserSeeder::class,
            AgendaTemplateSeeder::class,
            AgendaGiornalieraSeeder::class,
        ]);
    }
}
