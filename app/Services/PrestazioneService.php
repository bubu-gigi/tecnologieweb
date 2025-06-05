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
        $prestazione = Prestazione::create($data);
        return $prestazione;
    }

    public function update(string $id, array $data): Prestazione
    {
        $prestazione = Prestazione::findOrFail($id);
        $prestazione->update($data);
        return $prestazione;
    }

    public function delete(string $id): int
    {
        return Prestazione::destroy($id);
    }
}
