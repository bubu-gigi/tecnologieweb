<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AgendaService
{
    public function getAgendaTemplateByPrestazione(int $prestazioneId): array
    {
        $entries = DB::table('agenda_template')
            ->select('giorno', 'fascia_oraria')
            ->where('prestazione_id', $prestazioneId)
            ->orderBy('giorno')
            ->orderBy('fascia_oraria')
            ->get();

        $agenda = [];

        foreach ($entries as $entry) {
            $agenda[$entry->giorno][] = $entry->fascia_oraria;
        }

        return $agenda;
    }
}
