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
            'username' => 'admin',
            'password' => Hash::make('password'),
            'ruolo' => 'admin',
        ]);

        $staff = [
            [
                'nome' => 'Francesca',
                'cognome' => 'Verdi',
                'indirizzo' => 'Via Medica 10',
                'citta_nascita' => 'Milano',
                'username' => 'f.verdi',
                'password' => Hash::make('staff1'),
                'ruolo' => 'staff',
            ],
            [
                'nome' => 'Lorenzo',
                'cognome' => 'Rossi',
                'indirizzo' => 'Viale Ospedale 5',
                'citta_nascita' => 'Napoli',
                'username' => 'l.rossi',
                'password' => Hash::make('staff2'),
                'ruolo' => 'staff',
            ],
            [
                'nome' => 'Chiara',
                'cognome' => 'Bianchi',
                'indirizzo' => 'Via Salute 8',
                'citta_nascita' => 'Torino',
                'username' => 'c.bianchi',
                'password' => Hash::make('staff3'),
                'ruolo' => 'staff',
            ],
        ];

        foreach ($staff as $utente) {
            User::create($utente);
        }
    }
}
