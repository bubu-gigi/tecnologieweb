<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(Request $request): array
    {
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return [
                'error' => 'Credenziali non valide',
            ];
        } else {
            return [
                'nome' => $user->nome,
                'cognome' => $user->cognome,
                'username' => $user->username,
                'ruolo' => $user->ruolo,
            ];
        }
    }
}
