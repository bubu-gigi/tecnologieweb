<?php

namespace App\Services;

use App\Models\Prestazione;
use Illuminate\Support\Facades\DB;
use App\Models\AgendaGiornaliera;
use App\Models\Prenotazione;
use Carbon\Carbon;
use Illuminate\View\View;

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

    public function getSlot(int $prestazioneId): array
    {
        $entries = AgendaGiornaliera::select('data', 'orario', 'prenotazione_id')
            ->where('prestazione_id', $prestazioneId)
            ->whereBetween('data', ['2025-06-01', '2025-06-30'])
            ->orderBy('data')
            ->orderBy('orario')
            ->get();

        $slots = [];

        $prestazione = Prestazione::findOrFail($prestazioneId);

        foreach ($entries as $entry) {
            $slots[$entry->data][] = [
                'data' => $entry->data,
                'orario' => $entry->orario,
                'occupato' => $entry->prenotazione_id !== null,
            ];
        }

        return [
            'prestazione' => $prestazione,
            'slots' => $slots,
        ];
    }

    public function assegnaSlot(int $prenotazioneId, Carbon $data, string $slotOrario): bool
    {
        $prenotazione = Prenotazione::findOrFail($prenotazioneId);
        $prestazioneId = $prenotazione->prestazione_id;

        $slot = AgendaGiornaliera::where('prestazione_id', $prestazioneId)
            ->where('data', $data)
            ->where('orario', $slotOrario)
            ->whereNull('prenotazione_id')
            ->first();

        if (!$slot) {
            return false;
        }

        $prenotazione->data_prenotazione = $data . ' ' . $slotOrario;
        $prenotazione->save();

        $slot->prenotazione_id = $prenotazione->id;
        $slot->save();

        return true;
    }
}
