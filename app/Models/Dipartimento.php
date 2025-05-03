<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dipartimento extends Model
{
    use HasFactory;

    protected $table = 'dipartimenti';

    protected $fillable = [
        'nome',
        'descrizione',
    ];

    public function medici(): HasMany
    {
        return $this->hasMany(Medico::class);
    }

    public function prestazioni(): HasMany
    {
        return $this->hasMany(Prestazione::class);
    }
}
