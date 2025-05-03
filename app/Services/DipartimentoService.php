<?php

namespace App\Services;

use App\Models\Dipartimento;
use Illuminate\Database\Eloquent\Collection;

class DipartimentoService
{
    public function getAll(): Collection
    {
        return Dipartimento::with(['medici.prestazioni'])->get();;
    }

    public function getById(string $id): Dipartimento
    {
        return Dipartimento::find($id);
    }

    public function create(array $data): Dipartimento
    {
        return Dipartimento::create($data);
    }

    public function update(string $id, array $data): Dipartimento
    {
        $dip = Dipartimento::findOrFail($id);
        $dip->update($data);
        return $dip;
    }

    public function delete(string $id): int
    {
        return Dipartimento::destroy($id);
    }
}
