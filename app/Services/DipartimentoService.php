<?php

namespace App\Services;

use App\Models\Dipartimento;
use Illuminate\Database\Eloquent\Collection;

class DipartimentoService
{
    public function getAll(): Collection
    {
        return Dipartimento::all();
    }

    public function getById(string $id): Dipartimento
    {
        return Dipartimento::find($id);
    }
}
