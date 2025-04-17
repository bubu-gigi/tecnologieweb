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
        'giorno_id',
        'fascia_id',
        'max_prenotazioni',
    ];

    public function giorno(): BelongsTo
    {
        return $this->belongsTo(Giorno::class);
    }

    public function fascia(): BelongsTo
    {
        return $this->belongsTo(FasciaOraria::class, 'fascia_id');
    }
}
