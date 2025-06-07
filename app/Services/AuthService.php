<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(array $credentials): array|null
    {
        $user = User::where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return null;
        }

        Auth::login($user);

        session([
            'username' => $user->username,
            'ruolo' => $user->ruolo,
        ]);

        return [
            'id' => $user->id,
            'nome' => $user->nome,
            'cognome' => $user->cognome,
            'username' => $user->username,
            'ruolo' => $user->ruolo,
        ];
    }

    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }

}
