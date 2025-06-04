<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaTemplate extends Model
{
    protected $table = 'agenda_template';
    public $timestamps = false;

    protected $fillable = [
        'prestazione_id',
        'giorno',
        'fascia_oraria'
    ];

    public function prestazione()
    {
        return $this->belongsTo(Prestazione::class);
    }

    public function agendaTemplates()
    {
        return $this->hasMany(AgendaTemplate::class);
    }
}
