<?php

namespace App\Services;

use App\Models\Prenotazione;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class PrenotazioneService
{
    public function getAll(): Collection
    {
        return Prenotazione::where('deleted', false)->get();
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
        $prenotazione = Prenotazione::findOrFail($id);

        if (
            $prenotazione->data_prenotazione !== null &&
            Carbon::parse($prenotazione->data_prenotazione)->isPast()
        ) {
            throw new HttpResponseException(
                response()->json(['error' => 'Impossibile modificare una prenotazione già passata.'], 400)
            );
        }

        $prenotazione->update($data);
        return $prenotazione;
    }

    public function aggiornaDataPrenotazione(int $id, \Carbon\Carbon $dataPrenotazione): void
    {
        $prenotazione = Prenotazione::findOrFail($id);
        $prenotazione->data_prenotazione = $dataPrenotazione;
        $prenotazione->save();
    }


    public function delete(string $id): void
    {
        $prenotazione = Prenotazione::findOrFail($id);

        if (
            $prenotazione->data_prenotazione !== null &&
            Carbon::parse($prenotazione->data_prenotazione)->isPast()
        ) {
            throw new HttpResponseException(
                response()->json(['error' => 'Impossibile cancellare una prenotazione già passata.'], 400)
            );
        }
        $prenotazione->deleted = true;
        $prenotazione->save();
    }

    public function getByIdWithRelations(string $id): ?Prenotazione
    {
        return Prenotazione::with(['prestazione', 'user'])->find($id);
    }

    public function getInAttesa(): Collection
    {
        return Prenotazione::with(['user', 'prestazione'])
            ->whereNull('data_prenotazione')
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
