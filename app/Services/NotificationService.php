<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function creaNotifica(int $userId, int $prenotazioneId, string $azione, ?string $descrizione = null): Notification
    {
        return Notification::create([
            'user_id' => $userId,
            'prenotazione_id' => $prenotazioneId,
            'action' => $azione,
            'descrizione' => $descrizione,
            'notificata' => false,
        ]);
    }
}
