<?php

namespace App\Services;

use App\Models\Prestazione;
use Illuminate\Database\Eloquent\Collection;

class PrestazioneService
{
    public function getAll(): Collection
    {
        return Prestazione::all();
    }

    public function getById(string $id): Prestazione
    {
        return Prestazione::find($id);
    }

    public function searchByPrestazione(string $search): Collection
    {
        $search = trim($search);
        if (str_ends_with($search, '*')) {
            $pattern = rtrim($search, '*') . '%';
            return Prestazione::where('descrizione', 'LIKE', $pattern)->get();
        }
        return Prestazione::where('descrizione', $search)->get();
    }

    public function searchByDipartimento(string $search): Collection
    {
        $search = trim($search);

        if (str_ends_with($search, '*')) {
            $pattern = rtrim($search, '*') . '%';
            return Prestazione::whereHas('medico.dipartimento', function ($query) use ($pattern) {
                $query->where('nome', 'LIKE', $pattern);
            })->get();
        }

        return Prestazione::whereHas('medico.dipartimento', function ($query) use ($search) {
            $query->where('nome', $search);
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

    public function setPrestazioneStaffIdNullByStaffId(string $staffId): int
    {
        return Prestazione::where('staff_id', $staffId)->update(['staff_id' => null]);
    }
}
