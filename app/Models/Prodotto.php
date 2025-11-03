<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prodotto extends Model
{
    use HasFactory;

    protected $table = 'prodotti';

    protected $fillable = [
        'name',
        'image_name',
        'descrizione',
        'note_uso',
        'mod_installazione',
        'staff_id'
    ];

    public function malfunzionamenti(): HasMany
    {
        return $this->hasMany(Malfunzionamento::class);
    }
}
