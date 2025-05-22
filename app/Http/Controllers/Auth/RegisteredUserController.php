<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $previousUrl = url()->previous();

        if (!session()->has('register_referrer') && $previousUrl !== url()->current()) {
            session(['register_referrer' => $previousUrl]);
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'password' => Hash::make($request->password),
            'indirizzo' => $request->indirizzo,
            'citta' => $request->citta,
            'data_nascita' => $request->data_nascita,
            'username' => $request->username,
            'ruolo' => 'user',
        ]);

        Auth::login($user);

        $request->session()->forget('register_referrer');

        return redirect(RouteServiceProvider::CUSTOMERS);
    }
}
