<?php

namespace App\Services;

use App\Models\Medico;
use Illuminate\Database\Eloquent\Collection;

class MedicoService
{
    public function getAll(): Collection
    {
        return Medico::all();
    }

    public function getById(string $id): Medico
    {
        return Medico::findOrFail($id);
    }

    public function create(array $data): Medico
    {
        return Medico::create($data);
    }

    public function update(string $id, array $data): Medico
    {
        $dip = Medico::findOrFail($id);
        $dip->update($data);
        return $dip;
    }

    public function delete(string $id): int
    {
        return Medico::findOrFail($id)->delete();
    }

    public function deleteMediciByDipartimentoId(string $dipartimentoId): void
    {
        Medico::where('dipartimento_id', $dipartimentoId)->delete();
    }
}
