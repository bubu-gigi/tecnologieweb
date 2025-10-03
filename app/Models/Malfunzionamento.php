<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Malfunzionamento extends Model
{
    use HasFactory;

    protected $table = 'malfunzionamenti';

    protected $fillable = [
        'descrizione',
        'soluzione_tecnica',
    ];

    public function prodotto(): BelongsTo
    {
        return $this->belongsTo(Prodotto::class);
    }
}
