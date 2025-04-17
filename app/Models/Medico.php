<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medici';

    protected $fillable = [
        'nome',
        'cognome',
        'eta',
        'telefono',
        'email',
        'specializzazione',
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
}
