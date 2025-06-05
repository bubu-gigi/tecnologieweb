<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\PrenotazioneService;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\SearchPrestazioneRequest;
use App\Http\Requests\SearchDipartimentoRequest;
use App\Services\NotificaService;
use App\Services\PrestazioneService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    protected UserService $userService;
    protected PrenotazioneService $prenotazioneService;
    protected NotificaService $notificaService;
    protected PrestazioneService $prestazioneService;

    public function __construct(UserService $userService, PrenotazioneService $prenotazioneService, NotificaService $notificaService, PrestazioneService $prestazioneService)
    {
        $this->userService = $userService;
        $this->prenotazioneService = $prenotazioneService;
        $this->notificaService = $notificaService;
        $this->prestazioneService = $prestazioneService;
    }

    public function index(Request $request): View
    {
        if($request->query('showNotifications')){
            $notifiche = $this->notificaService->getByUserId(auth()->id());
            return view('customers.dashboard', compact('notifiche'));
        } else {
            return view('customers.dashboard');
        }
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
            'indirizzo' => $request->indirizzo,
            'citta' => $request->citta,
            'data_nascita' => $request->data_nascita,
            'username' => $request->username,
            'ruolo' => 'user',
        ];

        if (!empty($request->password)) {
            $user['password'] = $request->password;
        }

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

    public function searchPrestazione(Request $request): View
    {
        $prestazioni = [];

        if ($request->has('prestazione')) {
            $validated = app(SearchPrestazioneRequest::class)->validated();
            $prestazioni = $this->prestazioneService->searchByPrestazione($validated['prestazione']);
        } elseif ($request->has('dipartimento')) {
            $validated = app(SearchDipartimentoRequest::class)->validated();
            $prestazioni = $this->prestazioneService->searchByDipartimento($validated['dipartimento']);
        }

        return view('customers.prestazione', compact('prestazioni'));
    }

    public function storePrenotazione(Request $request)
    {
        $data = $request->only(keys: ['user_id', 'prestazione_id', 'giorno_escluso', 'data_prenotazione']);
        $this->prenotazioneService->create($data);
    }

    public function deletePrenotazione(string $id)
    {
        $this->prenotazioneService->delete($id);
    }
    public function deleteNotifica(string $id)
    {
        $this->notificaService->delete($id);
    }
}
