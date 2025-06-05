<?php

namespace App\Services;

use App\Models\Notifica;
use Illuminate\Database\Eloquent\Collection;

class NotificaService
{
    public function getByUserId(string $userId): Collection
    {
        return Notifica::where('user_id', $userId)->get();
    }
    public function create(array $data): Notifica
    {
        return Notifica::create($data);
    }

    public function delete(string $id): bool
    {
        return Notifica::destroy($id);
    }
}
