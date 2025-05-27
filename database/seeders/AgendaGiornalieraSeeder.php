<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AgendaGiornalieraSeeder extends Seeder
{
    public function run(): void
    {
        $giornaliera = [
            ['prestazione_id' => 1, 'data' => '2025-6-2', 'orario' => '8', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-2', 'orario' => '9', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-2', 'orario' => '10', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-2', 'orario' => '11', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-2', 'orario' => '12', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-2', 'orario' => '13', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-9', 'orario' => '8', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-9', 'orario' => '9', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-9', 'orario' => '10', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-9', 'orario' => '11', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-9', 'orario' => '12', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-9', 'orario' => '13', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-16', 'orario' => '8', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-16', 'orario' => '9', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-16', 'orario' => '10', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-16', 'orario' => '11', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-16', 'orario' => '12', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-16', 'orario' => '13', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-23', 'orario' => '8', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-23', 'orario' => '9', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-23', 'orario' => '10', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-23', 'orario' => '11', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-23', 'orario' => '12', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-23', 'orario' => '13', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-30', 'orario' => '8', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-30', 'orario' => '9', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-30', 'orario' => '10', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-30', 'orario' => '11', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-30', 'orario' => '12', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-30', 'orario' => '13', 'prenotazione_id' => null],

            ['prestazione_id' => 1, 'data' => '2025-6-3', 'orario' => '16', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-3', 'orario' => '17', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-3', 'orario' => '18', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-3', 'orario' => '19', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-10', 'orario' => '16', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-10', 'orario' => '17', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-10', 'orario' => '18', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-10', 'orario' => '19', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-17', 'orario' => '16', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-17', 'orario' => '17', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-17', 'orario' => '18', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-17', 'orario' => '19', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-24', 'orario' => '16', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-24', 'orario' => '17', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-24', 'orario' => '18', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-24', 'orario' => '19', 'prenotazione_id' => null],

            ['prestazione_id' => 1, 'data' => '2025-6-6', 'orario' => '16', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-6', 'orario' => '17', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-6', 'orario' => '18', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-6', 'orario' => '19', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-13', 'orario' => '16', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-13', 'orario' => '17', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-13', 'orario' => '18', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-13', 'orario' => '19', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-20', 'orario' => '16', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-20', 'orario' => '17', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-20', 'orario' => '18', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-20', 'orario' => '19', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-27', 'orario' => '16', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-27', 'orario' => '17', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-27', 'orario' => '18', 'prenotazione_id' => null],
            ['prestazione_id' => 1, 'data' => '2025-6-27', 'orario' => '19', 'prenotazione_id' => null],
        ];

        DB::table('agenda_giornaliera')->insert($giornaliera);
    }
}
