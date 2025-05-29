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
    public function getSlotDisponibilitaGiugno(int $prestazioneId): array
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


    public function getTabellaOccupazioneGiugno(int $prestazioneId): array
    {
        $template = $this->getAgendaTemplateByPrestazione($prestazioneId);

        $slots = DB::table('agenda_giornaliera')
            ->select('data', 'orario', 'prenotazione_id')
            ->where('prestazione_id', $prestazioneId)
            ->whereBetween('data', ['2025-06-01', '2025-06-30'])
            ->get();

        // Prepara una mappa veloce per lookup
        $mappaSlot = [];
        foreach ($slots as $slot) {
            $mappaSlot[$slot->data][$slot->orario] = $slot->prenotazione_id !== null;
        }

        // Costruisci la tabella finale
        $tabella = [];

        $inizio = new \DateTime('2025-06-01');
        $fine = new \DateTime('2025-06-30');

        for ($data = clone $inizio; $data <= $fine; $data->modify('+1 day')) {
            $giornoSettimana = $data->format('w'); // 0 (domenica) ... 6 (sabato)
            if ($giornoSettimana == 0 || !isset($template[$giornoSettimana])) {
                continue; // Skip domenica o giorni non nel template
            }

            $dataStr = $data->format('Y-m-d');
            $tabella[$dataStr] = [];

            foreach ($template[$giornoSettimana] as $slot) {
                $tabella[$dataStr][] = [
                    'orario' => $slot,
                    'occupato' => $mappaSlot[$dataStr][$slot] ?? false
                ];
            }
        }

        return $tabella;
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
