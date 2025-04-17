<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prestazione extends Model
{
    use HasFactory;

    protected $fillable = [
        'descrizione',
        'prescrizioni',
        'dipartimento_id',
    ];

    public function dipartimento(): BelongsTo
    {
        return $this->belongsTo(Dipartimento::class);
    }

    public function erogazioni(): HasMany
    {
        return $this->hasMany(Erogazione::class);
    }

    public function prenotazioni(): HasMany
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function monitoraggi(): HasMany
    {
        return $this->hasMany(Monitoraggio::class);
    }

}
