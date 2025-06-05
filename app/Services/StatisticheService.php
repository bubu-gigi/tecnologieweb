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

        // 1) Numero di prestazioni erogate per prestazione (tipo)
        $perPrestazione = Prestazione::selectRaw('descrizione, count(*) as totale')
            ->whereBetween('data_erogazione', [$dataInizio, $dataFine])
            ->groupBy('descrizione')
            ->get();

        // 2) Numero di prestazioni erogate per dipartimento
        $perDipartimento = Dipartimento::withCount([
            'prestazioni as totale_prestazioni' => function ($query) use ($dataInizio, $dataFine) {
                $query->whereBetween('data_erogazione', [$dataInizio, $dataFine]);
            }
        ])->get();

        // 3) Tutte le prestazioni erogate ad un utente specificato (se utente_id passato)
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
