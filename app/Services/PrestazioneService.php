<?php

namespace App\Services;

use App\Models\Prestazione;
use Illuminate\Database\Eloquent\Collection;

class PrestazioneService
{
    public function getAll(): Collection
    {
        return Prestazione::with(['medico', 'staff'])->get();
    }

    public function getById(string $id): Prestazione
    {
        return Prestazione::find($id);
    }

    public function searchByPrestazione(string $search): Collection
    {
        $pattern = str_replace('*', '%', $search);

        return Prestazione::where('descrizione', 'LIKE', $pattern)->get();
    }

    public function searchByDipartimento(string $search): Collection
    {
        $pattern = str_replace('*', '%', $search);

        return Prestazione::whereHas('medico.dipartimento', function ($query) use ($pattern) {
            $query->where('nome', 'LIKE', $pattern);
        })->get();
    }

    public function create(array $data): Prestazione
    {
        $fasce = [
            'giorno' => $data['giorno'] ?? [],
            'start_time' => $data['start_time'] ?? [],
            'end_time' => $data['end_time'] ?? []
        ];

        // Rimuovi le fasce dal data principale per non creare errori nel modello Prestazione
        unset($data['giorno'], $data['start_time'], $data['end_time']);

        $prestazione = Prestazione::create($data);

        foreach ($fasce['giorno'] as $index => $giorno) {
            if (empty($giorno) || empty($fasce['start_time'][$index]) || empty($fasce['end_time'][$index])) {
                continue; // salta fasce incomplete
            }

            // Inserisci nella tabella agenda_template, adattando i nomi delle colonne
            \DB::table('agenda_template')->insert([
                'prestazione_id' => $prestazione->id,
                'giorno' => $giorno,
                'start_time' => $fasce['start_time'][$index],
                'end_time' => $fasce['end_time'][$index],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $prestazione;
    }

    public function update(string $id, array $data): Prestazione
    {
        $fasce = [
            'giorno' => $data['giorno'] ?? [],
            'start_time' => $data['start_time'] ?? [],
            'end_time' => $data['end_time'] ?? []
        ];

        unset($data['giorno'], $data['start_time'], $data['end_time']);

        $prestazione = Prestazione::findOrFail($id);
        $prestazione->update($data);

        // Elimina fasce esistenti per questa prestazione e ricrea
        \DB::table('agenda_template')->where('prestazione_id', $id)->delete();

        foreach ($fasce['giorno'] as $index => $giorno) {
            if (empty($giorno) || empty($fasce['start_time'][$index]) || empty($fasce['end_time'][$index])) {
                continue;
            }

            \DB::table('agenda_template')->insert([
                'prestazione_id' => $prestazione->id,
                'giorno' => $giorno,
                'start_time' => $fasce['start_time'][$index],
                'end_time' => $fasce['end_time'][$index],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $prestazione;
    }

    public function delete(string $id): int
    {
        return Prestazione::destroy($id);
    }
}
