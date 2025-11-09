<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nome' => 'Mario',
            'cognome' => 'Rossi',
            'data_nascita' => '1985-05-10',
            'specializzazione' => null,
            'centro_assistenza_id' => 1,
            'username' => 'tecntecn',
            'password' => Hash::make('8Toh8Toh'), 
            'ruolo' => 'tecnico_assistenza',
        ]);

        User::create([
            'nome' => 'Luca',
            'cognome' => 'Bianchi',
            'data_nascita' => '1980-08-20',
            'specializzazione' => 'Elettronica',
            'centro_assistenza_id' => null,
            'username' => 'staffstaff',
            'password' => Hash::make('8Toh8Toh'),
            'ruolo' => 'tecnico_azienda',
        ]);

        User::create([
            'nome' => 'Anna',
            'cognome' => 'Verdi',
            'data_nascita' => '1978-02-15',
            'specializzazione' => null,
            'centro_assistenza_id' => null,
            'username' => 'adminadmin',
            'password' => Hash::make('8Toh8Toh'),
            'ruolo' => 'amministratore',
        ]);
    }
}
