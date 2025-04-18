<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestazione;

class PrestazioneSeeder extends Seeder
{
    public function run(): void
    {
        $prestazioni = [
            [
                'descrizione' => 'Elettrocardiogramma',
                'prescrizioni' => 'Richiesta del medico di base',
                'dipartimento_id' => 1,
            ],
            [
                'descrizione' => 'Risonanza Magnetica Cerebrale',
                'prescrizioni' => 'Impegnativa neurologica',
                'dipartimento_id' => 2,
            ],
            [
                'descrizione' => 'Visita Ortopedica',
                'prescrizioni' => 'Richiesta per dolore articolare',
                'dipartimento_id' => 3,
            ],
            [
                'descrizione' => 'Radiografia Torace',
                'prescrizioni' => 'Prescrizione del medico',
                'dipartimento_id' => 4,
            ],
            [
                'descrizione' => 'Visita Pediatrica Generale',
                'prescrizioni' => 'Paziente minore accompagnato',
                'dipartimento_id' => 5,
            ],
            [
                'descrizione' => 'Controllo Dermatologico',
                'prescrizioni' => 'Visita annuale preventiva',
                'dipartimento_id' => 6,
            ],
        ];

        foreach ($prestazioni as $prestazione) {
            Prestazione::create($prestazione);
        }
    }
}
