<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notifica extends Model
{
    use HasFactory;

    protected $table = 'notifiche';

    protected $fillable = [
        'user_id',
        'prenotazione_id',
        'action',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function prenotazione(): BelongsTo
    {
        return $this->belongsTo(Prenotazione::class);
    }
}
