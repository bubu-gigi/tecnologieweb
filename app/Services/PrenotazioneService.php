<?php

namespace App\Services;

use App\Models\Prenotazione;
use Illuminate\Database\Eloquent\Collection;

class PrenotazioneService
{
    public function getAll(): Collection
    {
        return Prenotazione::all();
    }

    public function getById(string $id): Prenotazione
    {
        return Prenotazione::find($id);
    }

    public function getPrenotazioniByUserId(string $userId): Collection
    {
        return Prenotazione::where('user_id', $userId)->get();
    }

    public function create(array $data): Prenotazione
    {
        return Prenotazione::create($data);
    }

    public function update(string $id, array $data): Prenotazione
    {
        $dip = Prenotazione::findOrFail($id);
        $dip->update($data);
        return $dip;
    }

    public function annullaPrenotazione(string $id): bool
    {
        $prenotazione = Prenotazione::findOrFail($id);

        if ($prenotazione->data_prenotazione !== null && Carbon::parse($prenotazione->data_prenotazione)->isPast()) {
            return false;
        }

        $prenotazione->delete();
        return true;
    }
}
