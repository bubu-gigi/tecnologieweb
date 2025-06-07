<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prenotazione extends Model
{
    use HasFactory;

    protected $table = 'prenotazioni';

    protected $fillable = [
        'user_id',
        'prestazione_id',
        'giorno_escluso',
        'data_prenotazione',
        'deleted',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function prestazione(): BelongsTo
    {
        return $this->belongsTo(Prestazione::class);
    }
}
