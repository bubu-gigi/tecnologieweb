<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CentroAssistenza;

class CentriAssistenzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centri = [
            ['nome' => 'Tech Center Ancona', 'indirizzo' => 'Via Roma 12'],
            ['nome' => 'InfoSupport Jesi', 'indirizzo' => 'Corso Matteotti 5'],
            ['nome' => 'Assistenza PC Falconara', 'indirizzo' => 'Viale Europa 33'],
            ['nome' => 'Centro Informatica Senigallia', 'indirizzo' => 'Via XX Settembre 21'],
            ['nome' => 'Supporto Marche Nord', 'indirizzo' => 'Piazza della Repubblica 8'],
            ['nome' => 'TechPoint Fano', 'indirizzo' => 'Via Mazzini 10'],
            ['nome' => 'Assistenza Informatica Macerata', 'indirizzo' => 'Via Garibaldi 4'],
            ['nome' => 'InfoTech Civitanova', 'indirizzo' => 'Corso Umberto I 18'],
            ['nome' => 'PC Doctor Fermo', 'indirizzo' => 'Via Cavour 15'],
            ['nome' => 'HelpDesk Ascoli', 'indirizzo' => 'Piazza Arringo 2'],
        ];

        foreach ($centri as $centro) {
            CentroAssistenza::create($centro);
        }
    }
}
