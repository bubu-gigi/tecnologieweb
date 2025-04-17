<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FasciaOraria extends Model
{
    use HasFactory;

    protected $table = 'fascie_orarie';

    protected $fillable = [
        'inizio',
        'fine',
    ];

    public function agende(): HasMany
    {
        return $this->hasMany(Agenda::class, 'fascia_id');
    }
}
