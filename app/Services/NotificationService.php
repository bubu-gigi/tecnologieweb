<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;

class NotificationService
{
    public function getNotificationsByUserId(string $userId): Collection
    {
        return Notification::where('user_id', $userId)->get();
    }
    public function creaNotifica(array $data): Notification
    {
        return Notification::create($data);
    }

    public function delete(string $id): bool
    {
        return Notification::destroy($id);
    }
}
