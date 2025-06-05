<?php

namespace App\Services;

use App\Models\Prestazione;
use App\Models\AgendaGiornaliera;
use App\Models\AgendaTemplate;
use App\Models\Notifica;
use App\Models\Prenotazione;
use Carbon\Carbon;

class AgendaService
{
    public function getAgendaTemplateByPrestazione(int $prestazioneId): array
    {
        $entries = AgendaTemplate::select('giorno', 'fascia_oraria')
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
                'orario' => $entry->orario,
                'occupato' => $entry->prenotazione_id !== null,
            ];
        }

        return [
            'prestazione' => $prestazione,
            'slots' => $slots,
        ];
    }

    public function assegnaSlot(int $prenotazioneId, string $date, string $time): bool
    {
        $prenotazione = Prenotazione::findOrFail($prenotazioneId);

        if ($prenotazione->data_prenotazione) {
            $vecchioDatetime = Carbon::parse($prenotazione->data_prenotazione);
            $vecchiaData = $vecchioDatetime->format('Y-m-d');
            $vecchioOrario = (int) $vecchioDatetime->format('H');
            AgendaGiornaliera::where('prestazione_id', $prenotazione->prestazione->id)
                ->where('data', $vecchiaData)
                ->where('orario', $vecchioOrario)
                ->where('prenotazione_id', $prenotazione->id)
                ->update(['prenotazione_id' => null]);
            Notifica::create(["user_id" => $prenotazione->user->id, "prenotazione_id" => $prenotazione->id, "action" => "modified" ]);
        }

        $datetime = Carbon::parse($date . ' ' . $time . ':00');
        $prenotazione->data_prenotazione = $datetime;
        $prenotazione->save();

        $slot = AgendaGiornaliera::where('prestazione_id', $prenotazione->prestazione->id)
            ->where('data', $date)
            ->where('orario',  (int) $time)
            ->first();
        if (!$slot) {
            return false;
        }

        $slot->prenotazione_id = $prenotazione->id;
        $slot->save();

        return true;
    }

    public function createTemplateRow(int $prestazioneId, string $giorno, string $fasciaOraria): AgendaTemplate
    {
        return AgendaTemplate::create([
            'prestazione_id' => $prestazioneId,
            'giorno' => $giorno,
            'fascia_oraria' => $fasciaOraria,
        ]);
    }

    public function createGiornalieraRow(int $prestazioneId, string $data, string $orario): AgendaGiornaliera
    {
        return AgendaGiornaliera::create([
            'prestazione_id' => $prestazioneId,
            'data' => $data,
            'orario' => $orario,
        ]);
    }

    public function deleteTemplateByPrestazioneId(int $id)
    {
        AgendaTemplate::where('prestazione_id', $id)->delete();
    }

    public function deleteGiornalieraByPrestazioneId(int $id, string $fromDate)
    {
        AgendaGiornaliera::where('prestazione_id', $id)
            ->where('data', '>=', $fromDate)
            ->whereMonth('data', 6)
            ->delete();
    }

    public function deleteGiornalieraByPrenotazioneId(int $id)
    {
        AgendaGiornaliera::where('prenotazione_id', $id)->delete();
    }

    public function deleteInvalidPrenotazioni(int $prestazioneId, array $fasceOrarie)
    {
        $slots = AgendaGiornaliera::where('prestazione_id', $prestazioneId)
            ->whereNotNull('prenotazione_id')
            ->get();

        foreach ($slots as $slot) {
            $giornoSettimana = \Carbon\Carbon::parse($slot->data)->dayOfWeekIso;
            $ora = intval($slot->orario);

            if (!isset($fasceOrarie[$giornoSettimana]) || !in_array($ora, $fasceOrarie[$giornoSettimana])) {
                $slot->prenotazione?->delete();
                $slot->delete();
            }
        }
    }


}
