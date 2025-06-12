<?php

namespace App\Services;

use App\Models\Prenotazione;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class PrenotazioneService
{
    public function getAll(): Collection
    {
        return Prenotazione::where('deleted', false)->get();
    }

    public function getById(string $id): ?Prenotazione
    {
        return Prenotazione::findOrFail($id);
    }

    public function getPrenotazioniByPrestazioneId(string $id): Collection
    {
        return Prenotazione::where('prestazione_id', $id)->get();
    }

    public function getPrenotazioniByPrestazioneIdAndFromToday(string $id): Collection
    {
        return Prenotazione::where('prestazione_id', $id)
            ->whereNotNull('data_prenotazione')
            ->where('deleted', false)
            ->whereDate('data_prenotazione', '>=', Carbon::today())
            ->get();
    }


    public function getByStaffId(string $id): Collection
    {
        return Prenotazione::where('deleted', false)
            ->whereHas('prestazione', function ($query) use ($id) {
                $query->where('staff_id', $id)
                    ->orWhereNull('staff_id');
            })
            ->get();
    }

    public function getPrenotazioniByUserId(string $userId): Collection
    {
        return Prenotazione::where('deleted', false)->where('user_id', $userId)->get();
    }

    public function create(array $data): Prenotazione
    {
        return Prenotazione::create($data);
    }

    public function update(string $id, array $data): Prenotazione
    {
        $prenotazione = Prenotazione::findOrFail($id);
        $prenotazione->update($data);
        return $prenotazione;
    }

    public function delete(string $id): void
    {
        $prenotazione = Prenotazione::findOrFail($id);
        $prenotazione->deleted = true;
        $prenotazione->save();
    }

    public function deleteByPrestazioneId(string $prestazioneId): void
    {
        Prenotazione::where('prestazione_id', $prestazioneId)->delete();
    }

    public function deletePrenotazioniByDipartimentoId(string $dipartimentoId)
    {
        return Prenotazione::whereHas('prestazione.medico', function ($query) use ($dipartimentoId) {
            $query->where('dipartimento_id', $dipartimentoId);
        })->delete();
    }
}
