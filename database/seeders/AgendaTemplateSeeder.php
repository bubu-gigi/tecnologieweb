<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgendaTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $template = [
            ['prestazione_id' => 1, 'giorno' => 1, 'fascia_oraria' => '8-14'],
            ['prestazione_id' => 1, 'giorno' => 2, 'fascia_oraria' => '8-14'],
            ['prestazione_id' => 1, 'giorno' => 3, 'fascia_oraria' => '16-20'],
            ['prestazione_id' => 1, 'giorno' => 5, 'fascia_oraria' => '16-20'],
            ['prestazione_id' => 2, 'giorno' => 4, 'fascia_oraria' => '8-14'],
            ['prestazione_id' => 2, 'giorno' => 5, 'fascia_oraria' => '8-14'],
            ['prestazione_id' => 3, 'giorno' => 1, 'fascia_oraria' => '16-20'],
            ['prestazione_id' => 3, 'giorno' => 5, 'fascia_oraria' => '16-20'],
        ];

        DB::table('agenda_template')->insert($template);
    }
}
