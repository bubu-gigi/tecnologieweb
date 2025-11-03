<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        $previousUrl = url()->previous();

        if (!session()->has('login_referrer') && $previousUrl !== url()->current()) {
            session(['login_referrer' => $previousUrl]);
        }

        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors(['login_error' => 'Credenziali non valide. Riprova.'])
                ->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();

        session([
            'user_id' => $user->id,
            'username' => $user->username,
            'nome' => $user->nome,
            'cognome' => $user->cognome,
            'role' => $user->ruolo,
        ]);

        $request->session()->forget('login_referrer');

        switch ($user->ruolo) {
            case 'amministratore':
                return redirect()->route('amministratore.dashboard');
            case 'tecnico_assistenza':
                return redirect()->route('tecnicoAssistenza.dashboard');
            case 'tecnico_azienda':
                return redirect()->route('tecnicoAzienda.dashboard');
            default:
                return redirect('/');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}