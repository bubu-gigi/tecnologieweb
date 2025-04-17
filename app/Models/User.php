<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nome',
        'cognome',
        'indirizzo',
        'citta_nascita',
        'username',
        'password',
        'ruolo',
    ];

    protected $hidden = [
        'password',
        //'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function prenotazioni(): HasMany
    {
        return $this->hasMany(Prenotazione::class);
    }

    public function monitoraggi(): HasMany
    {
        return $this->hasMany(Monitoraggio::class);
    }
}
