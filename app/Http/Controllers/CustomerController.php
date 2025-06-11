<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\PrenotazioneService;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Services\AgendaService;
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
    protected AgendaService $agendaService;

    public function __construct(UserService $userService, PrenotazioneService $prenotazioneService, NotificaService $notificaService, PrestazioneService $prestazioneService, AgendaService $agendaService)
    {
        $this->userService = $userService;
        $this->prenotazioneService = $prenotazioneService;
        $this->notificaService = $notificaService;
        $this->prestazioneService = $prestazioneService;
        $this->agendaService = $agendaService;
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
        $prenotazioni = $this->prenotazioneService->getPrenotazioniByUserId(auth()->user()->id);
        return view('customers.prenotazioni', compact('prenotazioni'));
    }

    public function editProfilo(): View
    {
        $user = Auth::user();
        return view('customers.profile', compact('user'));
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

    public function searchPrestazione(SearchRequest $request): View
    {
        $prestazioni = [];

        if ($request->filled('prestazione')) {
            $prestazioni = $this->prestazioneService->searchByPrestazione($request->prestazione);
        } elseif ($request->filled('dipartimento')) {
            $prestazioni = $this->prestazioneService->searchByDipartimento($request->dipartimento);
        }

        return view('customers.prestazione', compact('prestazioni'));
    }

    public function storePrenotazione(Request $request)
    {
        $data = $request->only(keys: ['user_id', 'prestazione_id', 'giorno_escluso', 'data_prenotazione']);
        $this->prenotazioneService->create($data);
    }

    public function deletePrenotazione(string $prenotazioneId)
    {
        $this->agendaService->deleteGiornalieraByPrenotazioneId($prenotazioneId);
        $this->prenotazioneService->delete($prenotazioneId);
    }
    public function deleteNotifica(string $id)
    {
        $this->notificaService->delete($id);
    }
}
