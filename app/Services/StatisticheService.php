<?php
namespace App\Services;

use App\Models\Prenotazione;

class StatisticheService
{
    public function getStatistiche(array $filters): array
    {

        if (empty($filters['data_inizio']) || empty($filters['data_fine'])) {
            return [
                'perPrestazione' => collect(),
                'perDipartimento' => collect(),
                'prestazioniUtente' => collect(),
            ];
        }

        $query = Prenotazione::whereBetween('data_prenotazione', [$filters['data_inizio'], $filters['data_fine']]);

        if (!empty($filters['utente_id'])) {
            $query->where('user_id', $filters['utente_id']);
        }

        $base = $query->with('prestazione.medico.dipartimento')->get();

        $perPrestazione = $base->groupBy('prestazione_id')->map(function ($items) {
            $first = $items->first();
            return [
                'descrizione' => $first->prestazione->descrizione ?? 'N/D',
                'totale' => count($items),
            ];
        })->values();

        $perDipartimento = $base->groupBy(fn ($item) => $item->prestazione->medico->dipartimento->nome ?? 'N/D')
            ->map(fn ($group) => $group->count());

        $prestazioniUtente = !empty($filters['utente_id']) ? $base->map(function ($item) {
            return (object)[
                'data' => $item->data_prenotazione,
                'prestazione' => $item->prestazione->descrizione ?? 'N/D',
                'dipartimento' => $item->prestazione->medico->dipartimento->nome ?? 'N/D',
            ];
        }) : collect();

        return [
            'perPrestazione' => $perPrestazione,
            'perDipartimento' => $perDipartimento,
            'prestazioniUtente' => $prestazioniUtente,
        ];
    }
}
