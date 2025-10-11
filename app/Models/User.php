<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nome',
        'cognome',
        'data_nascita',
        'specializzazione',
        'centro_assistenza_id',
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

        public function centroAssistenza()  
    {
        return $this->belongsTo(CentroAssistenza::class, 'centro_assistenza_id');
    }

}
