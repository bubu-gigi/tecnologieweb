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
    public function create(array $data)
    {
         Notifica::firstOrCreate([
            'user_id' => $data['user_id'],
            'action' => $data['action'],
            'prenotazione_id' => $data['prenotazione_id'],
        ]);
    }

    public function delete(string $id): bool
    {
        return Notifica::findOrFail($id)->delete();
    }
}
