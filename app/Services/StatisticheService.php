<?php

namespace App\Services;

use App\Models\Prenotazione;
use Illuminate\Support\Collection;

class StatisticheService
{
    public function getStatistiche(array $filters): array
    {
        if (!isset($filters['data_inizio'], $filters['data_fine'])) {
            return [
                'perPrestazione' => collect(),
                'perDipartimento' => collect(),
                'prestazioniUtente' => collect(),
            ];
        }

        $dataInizio = $filters['data_inizio'];
        $dataFine = $filters['data_fine'];
        $utenteId = $filters['utente_id'] ?? null;

        $perPrestazione = Prenotazione::selectRaw('prestazione_id, count(*) as totale')
            ->whereBetween('data_prenotazione', [$dataInizio, $dataFine])
            ->with('prestazione')
            ->groupBy('prestazione_id')
            ->get()
            ->map(function ($item) {
                return [
                    'descrizione' => $item->prestazione->descrizione ?? 'N/D',
                    'totale' => $item->totale,
                ];
            });

        $perDipartimento = Prenotazione::with('prestazione.medico.dipartimento')
            ->whereBetween('data_prenotazione', [$dataInizio, $dataFine])
            ->get()
            ->groupBy(function ($prenotazione) {
                return $prenotazione->prestazione->medico->dipartimento->nome ?? 'N/D';
            })
            ->map(function ($group) {
                return count($group);
            });

        $prestazioniUtente = collect();
        if ($utenteId) {
            $prestazioniUtente = Prenotazione::with(['prestazione.medico.dipartimento'])
                ->where('user_id', $utenteId)
                ->whereBetween('data_prenotazione', [$dataInizio, $dataFine])
                ->get()
                ->map(function ($prenotazione) {
                    return (object) [
                        'data' => $prenotazione->data_prenotazione,
                        'prestazione' => $prenotazione->prestazione->descrizione ?? 'N/D',
                        'dipartimento' => $prenotazione->prestazione->medico->dipartimento->nome ?? 'N/D',
                    ];
                });
        }

        return [
            'perPrestazione' => $perPrestazione,
            'perDipartimento' => $perDipartimento,
            'prestazioniUtente' => $prestazioniUtente,
        ];
    }
}
