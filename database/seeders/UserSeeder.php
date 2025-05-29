<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nome' => 'Admin',
            'cognome' => 'System',
            'username' => 'admin00',
            'password' => Hash::make('password'),
            'ruolo' => 'admin',
        ]);

        $users = [
            [
                'nome' => 'Francesca',
                'cognome' => 'Verdi',
                'indirizzo' => 'Via Medica, 10',
                'citta' => 'Milano',
                'data_nascita' => '1990-05-15',
                'username' => 'f.verdi',
                'password' => Hash::make('passwordfv'),
                'ruolo' => 'user',
            ],
            [
                'nome' => 'Lorenzo',
                'cognome' => 'Rossi',
                'username' => 'l.rossi',
                'password' => Hash::make('passwordlr'),
                'ruolo' => 'staff',
            ],
            [
                'nome' => 'Chiara',
                'cognome' => 'Bianchi',
                'username' => 'c.bianchi',
                'password' => Hash::make('passwordcb'),
                'ruolo' => 'staff',
            ],
            //utenti per la consegna del progetto
            [
                'nome' => 'pazi',
                'cognome' => 'pazi',
                'indirizzo' => 'Via ',
                'citta' => 'Milano',
                'data_nascita' => '1990-05-15',
                'username' => 'pazipazi',
                'password' => Hash::make('ha5nha5n'),
                'ruolo' => 'user',
            ],
            [
                'nome' => 'staff',
                'cognome' => 'staff',
                'username' => 'staffstaff',
                'password' => Hash::make('ha5nha5n'),
                'ruolo' => 'staff',
            ],
            [
                'nome' => 'admin',
                'cognome' => 'admin',
                'username' => 'adminadmin',
                'password' => Hash::make('ha5nha5n'),
                'ruolo' => 'admin',
            ]
        ];

        foreach ($staff as $utente) {
            User::create($utente);
        }
    }
}
