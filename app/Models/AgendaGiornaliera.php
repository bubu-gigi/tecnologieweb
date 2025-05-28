<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaGiornaliera extends Model
{
    protected $table = 'agenda_giornaliera';
    public $timestamps = false;

    protected $fillable = [
        'prestazione_id',
        'prenotazione_id',
        'data',
        'orario'
    ];

    public function prestazione()
    {
        return $this->belongsTo(Prestazione::class);
    }

    public function prenotazione()
    {
        return $this->belongsTo(Prenotazione::class);
    }
}
