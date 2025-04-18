<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agende';

    protected $fillable = [
        'giorno',
        'ora',
        'prenotati',
        'max_prenotazioni',
        'prestazione_id',
    ];

    public function prestazione(): BelongsTo
    {
        return $this->belongsTo(Prestazione::class);
    }
}
