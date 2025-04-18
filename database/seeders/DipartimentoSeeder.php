<?php

namespace Database\Seeders;

use App\Models\Dipartimento;
use Illuminate\Database\Seeder;

class DipartimentoSeeder extends Seeder
{
    public function run(): void
    {
        $dipartimenti = [
            ['nome' => 'Cardiologia', 'descrizione' => 'Trattamento delle malattie cardiovascolari.'],
            ['nome' => 'Neurologia', 'descrizione' => 'Diagnosi e cura delle malattie del sistema nervoso.'],
            ['nome' => 'Ortopedia', 'descrizione' => 'Cura delle patologie dell’apparato muscolo-scheletrico.'],
            ['nome' => 'Radiologia', 'descrizione' => 'Diagnostica per immagini e radiografie.'],
            ['nome' => 'Pediatria', 'descrizione' => 'Cure mediche per bambini e adolescenti.'],
            ['nome' => 'Dermatologia', 'descrizione' => 'Trattamento delle patologie della pelle.'],
        ];

        foreach ($dipartimenti as $dip) {
            Dipartimento::create($dip);
        }
    }
}
