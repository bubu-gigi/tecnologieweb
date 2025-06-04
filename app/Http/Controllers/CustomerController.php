<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\PrenotazioneService;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\SearchPrestazioneRequest;
use App\Http\Requests\SearchDipartimentoRequest;
use App\Services\NotificationService;
use App\Services\PrestazioneService;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    protected UserService $userService;
    protected PrenotazioneService $prenotazioneService;
    protected NotificationService $notificationService;
    protected PrestazioneService $prestazioneService;

    public function __construct(UserService $userService, PrenotazioneService $prenotazioneService, NotificationService $notificationService, PrestazioneService $prestazioneService)
    {
        $this->userService = $userService;
        $this->prenotazioneService = $prenotazioneService;
        $this->notificationService = $notificationService;
        $this->prestazioneService = $prestazioneService;
    }

    public function index(Request $request): View
    {
        if($request->query('showNotifications')){
            $notifications = $this->notificationService->getNotificationsByUserId(auth()->id())->map(function ($notification) {
            if ($notification->prenotazione && $notification->prenotazione->data_prenotazione) {
                $notification->prenotazione->data_prenotazione = Carbon::parse($notification->prenotazione->data_prenotazione)->format('d/m/Y H:i');
            }
            return $notification;
        });;
            return view('customers.dashboard', compact('notifications'));
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

    public function storePrenotazione(Request $request): JsonResponse
    {
        $data = $request->only(keys: ['user_id', 'prestazione_id', 'giorno_escluso', 'data_prenotazione']);
        $prenotazione = $this->prenotazioneService->create($data);
        return response()->json($prenotazione, 201);
    }

    public function destroyPrenotazione(string $id): RedirectResponse
    {
        $success = $this->prenotazioneService->delete($id);

        if (!$success) {
            return redirect()->back()->withErrors(['La prestazione è già stata erogata e non può essere annullata.']);
        }

        return redirect()->route('customers.prenotazioni')->with('success', 'Prenotazione annullata con successo.');
    }

    // prenotazioni controller
    public function indexPrenotazioni(): JsonResponse
    {
        $prenotazione = $this->prenotazioneService->getAll();
        return response()->json($prenotazione);
    }

    public function show(string $id): JsonResponse
    {
        $prenotazione = $this->prenotazioneService->getById($id);
        return response()->json($prenotazione);
    }

    public function destroyNotification(string $id)
    {
        $this->notificationService->delete($id);
    }
}
