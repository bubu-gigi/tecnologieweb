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
    /**
     * Display the registration view.
     */
    public function create(): View
    {
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
            'citta_nascita' => $request->citta,
            'data_nascita' => $request->dataNascita,
            'username' => $request->username,
            'ruolo' => 'user',
        ]);

        Auth::login($user);

        if ($request->has('redirect_to')) {
            return redirect($request->get('redirect_to'));
        } else {
            return redirect(RouteServiceProvider::CUSTOMERS);
        }
    }
}
