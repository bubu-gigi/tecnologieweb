<?php

namespace App\Http\Controllers;

use App\Services\PrenotazioneService;
use Illuminate\View\View;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    protected PrenotazioneService $prenotazioneService;

    public function __construct(PrenotazioneService $prenotazioneService)
    {
        $this->prenotazioneService = $prenotazioneService;
    }

    public function index(): View
    {
        return view('customers.dashboard');
    }

    public function prestazioni(): View
    {
        return view('customers.prestazione');
    }

    public function prenotazioni(): View
    {
        $user = auth()->user();
        $prenotazioni = $this->prenotazioneService->getPrenotazioniByUserId($user->id);
        return view('customers.prenotazioni', compact('prenotazioni'));
    }

    public function editProfilo(Request $request): View
    {
        return view('customers.profile', [
            'user' => $request->user(),
        ]);
    }
    public function updateProfilo(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = [
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'password' => Hash::make($request->password),
            'indirizzo' => $request->indirizzo,
            'citta' => $request->citta,
            'data_nascita' => $request->data_nascita,
            'username' => $request->username,
            'ruolo' => 'user',
        ];

        $this->userService->update($request->user()->id, $user);

        return Redirect::route('customers.dashboard');
    }

    public function destroyProfilo(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
