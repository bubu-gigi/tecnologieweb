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
        'titolo',
        'dipartimento',
        'giorno',
        'fascia_oraria',
    ]; 
//da rivedere aggiunta (sopra da Titolo a fascia_oraria)
    public function medico(): BelongsTo
    {
        return $this->belongsTo(Medico::class);
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
