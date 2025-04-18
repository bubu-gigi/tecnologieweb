<?php

namespace Database\Seeders;

use App\Models\Medico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicoSeeder extends Seeder
{
    public function run(): void
    {
        // Assumiamo che i dipartimenti abbiano ID da 1 a 6
        $medici = [
            [
                'nome' => 'Luca',
                'cognome' => 'Rossi',
                'eta' => 45,
                'telefono' => '3401234567',
                'email' => 'l.rossi@example.com',
                'specializzazione' => 'Cardiologo',
                'dipartimento_id' => 1,
            ],
            [
                'nome' => 'Giulia',
                'cognome' => 'Bianchi',
                'eta' => 38,
                'telefono' => '3402233445',
                'email' => 'g.bianchi@example.com',
                'specializzazione' => 'Neurologa',
                'dipartimento_id' => 2,
            ],
            [
                'nome' => 'Marco',
                'cognome' => 'Verdi',
                'eta' => 50,
                'telefono' => '3403344556',
                'email' => 'm.verdi@example.com',
                'specializzazione' => 'Ortopedico',
                'dipartimento_id' => 3,
            ],
            [
                'nome' => 'Sara',
                'cognome' => 'Neri',
                'eta' => 41,
                'telefono' => '3404455667',
                'email' => 's.neri@example.com',
                'specializzazione' => 'Radiologa',
                'dipartimento_id' => 4,
            ],
            [
                'nome' => 'Paolo',
                'cognome' => 'Gialli',
                'eta' => 36,
                'telefono' => '3405566778',
                'email' => 'p.gialli@example.com',
                'specializzazione' => 'Pediatra',
                'dipartimento_id' => 5,
            ],
            [
                'nome' => 'Elena',
                'cognome' => 'Rosa',
                'eta' => 42,
                'telefono' => '3406677889',
                'email' => 'e.rosa@example.com',
                'specializzazione' => 'Dermatologa',
                'dipartimento_id' => 6,
            ],
        ];

        foreach ($medici as $medico) {
            Medico::create($medico);
        }
    }
}
