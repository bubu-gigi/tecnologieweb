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
                'medico_id' => 1,
            ],
            [
                'descrizione' => 'Risonanza Magnetica Cerebrale',
                'prescrizioni' => 'Impegnativa neurologica',
                'medico_id' => 2,
            ],
            [
                'descrizione' => 'Visita Ortopedica',
                'prescrizioni' => 'Richiesta per dolore articolare',
                'medico_id' => 3,
            ],
            [
                'descrizione' => 'Radiografia Torace',
                'prescrizioni' => 'Prescrizione del medico',
                'medico_id' => 4,
            ],
            [
                'descrizione' => 'Visita Pediatrica Generale',
                'prescrizioni' => 'Paziente minore accompagnato',
                'medico_id' => 5,
            ],
            [
                'descrizione' => 'Controllo Dermatologico',
                'prescrizioni' => 'Visita annuale preventiva',
                'medico_id' => 6,
            ],
        ];

        foreach ($prestazioni as $prestazione) {
            Prestazione::create($prestazione);
        }
    }
}
