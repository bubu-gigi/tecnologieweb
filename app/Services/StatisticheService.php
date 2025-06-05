<?php

namespace App\Services;

use App\Models\Prestazione;
use App\Models\Dipartimento;

class StatisticheService
{
    /**
     * Restituisce le statistiche delle prestazioni in base ai filtri.
     *
     * @param array $filters ['data_inizio' => ..., 'data_fine' => ..., 'utente_id' => ...]
     * @return array
     */
    public function getStatistiche(array $filters): array
    {
        if (!isset($filters['data_inizio'], $filters['data_fine'])) {
            return [
                'perPrestazione' => [],
                'perDipartimento' => [],
                'prestazioniUtente' => [],
            ];
        }

        $dataInizio = $filters['data_inizio'];
        $dataFine = $filters['data_fine'];
        $utenteId = $filters['utente_id'] ?? null;

        $perPrestazione = Prestazione::selectRaw('descrizione, count(*) as totale')
            ->whereBetween('data_erogazione', [$dataInizio, $dataFine])
            ->groupBy('descrizione')
            ->get();

        $perDipartimento = Dipartimento::withCount([
            'prestazioni as totale_prestazioni' => function ($query) use ($dataInizio, $dataFine) {
                $query->whereBetween('data_erogazione', [$dataInizio, $dataFine]);
            }
        ])->get();

        $prestazioniUtente = [];
        if ($utenteId) {
            $prestazioniUtente = Prestazione::where('utente_id', $utenteId)
                ->whereBetween('data_erogazione', [$dataInizio, $dataFine])
                ->get();
        }

        return [
            'perPrestazione' => $perPrestazione,
            'perDipartimento' => $perDipartimento,
            'prestazioniUtente' => $prestazioniUtente,
        ];
    }
}
