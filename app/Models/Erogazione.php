<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Erogazione extends Model
{
    use HasFactory;

    protected $table = 'erogazioni';

    protected $fillable = [
        'medico_id',
        'prestazione_id',
    ];

    public function medico(): BelongsTo
    {
        return $this->belongsTo(Medico::class);
    }

    public function prestazione(): BelongsTo
    {
        return $this->belongsTo(Prestazione::class);
    }
}
