<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Giorno extends Model
{
    use HasFactory;

    protected $table = 'giorni';

    protected $fillable = [
        'nome',
    ];

    public function agende(): HasMany
    {
        return $this->hasMany(Agenda::class, 'giorno_id');
    }
}
