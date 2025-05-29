<?php

namespace App\Http\Controllers;

use App\Services\PrenotazioneService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Prenotazione;

class StaffController extends Controller
{
    protected PrenotazioneService $prenotazioneService;

    public function __construct(PrenotazioneService $prenotazioneService)
    {
        $this->prenotazioneService = $prenotazioneService;
    }

    public function index(): View
    {
        return view('staff.dashboard');
    }
    
    public function prenotazioni(): View
    {
        $prenotazioni = $this->prenotazioneService->getAll();
        return view('staff.prenotazioni', compact('prenotazioni'));
    }

    

    public function dettagliPrenotazione($id)
    {
        $prenotazione = Prenotazione::with('prestazione', 'user')->find($id);

        if (!$prenotazione) {
            return response()->json([
                'success' => false,
                'message' => 'Prenotazione non trovata.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $prenotazione
        ]);
    }

    public function prenotazioniInAttesa()
    {
        $prenotazioni = Prenotazione::with(['user', 'prestazione'])
            ->whereNull('data_prenotazione')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $prenotazioni
        ]);
    }
}
