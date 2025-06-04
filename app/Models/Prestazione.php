<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prestazione extends Model
{
    use HasFactory;

    protected $table = 'prestazioni';

    protected $fillable = [
        'descrizione',
        'prescrizioni',
        'medico_id',
        'staff_id'
    ];
    
    public function medico(): BelongsTo
    {
        return $this->belongsTo(Medico::class);
    }

    public function prenotazioni(): HasMany
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
