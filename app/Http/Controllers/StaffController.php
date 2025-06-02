<?php

namespace App\Http\Controllers;

use App\Services\PrenotazioneService;
use Illuminate\View\View;
use Illuminate\Http\Request;

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
        $prenotazione = $this->prenotazioneService->getByIdWithRelations($id);

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
        $prenotazioni = $this->prenotazioneService->getInAttesa();

        return response()->json([
            'success' => true,
            'data' => $prenotazioni
        ]);
    }

    public function getTemplate(int $prestazioneId): JsonResponse
    {
        $data = $this->agendaService->getAgendaTemplateByPrestazione($prestazioneId);
        return response()->json(['success' => true, 'data' => $data]);
    }
    
    public function getSlot(int $prestazioneId): View
    {
        $data = $this->agendaService->getSlot($prestazioneId);

        return view('prestazioni_agenda', [
            'prestazione' => $data['prestazione'],
            'slots' => $data['slots'],
        ]);
    }

    public function assegnaSlot(Request $request, int $procedure): JsonResponse
    {
        $validated = $request->validated();

        $ok = $this->agendaService->assegnaSlot($data['prenotazione_id'], Carbon::parse($request->input('data')), $data['slot_orario']);

        if (!$ok) {
            return response()->json(['success' => false, 'message' => 'Slot non disponibile'], 409);
        }

        return response()->json(['success' => true, 'message' => 'Slot assegnato']);
    }

    public function updatePrenotazione(Request $request, string $id): JsonResponse
    {
        $data = $request->only(keys: ['user_id', 'prestazione_id', 'giorno_escluso', 'data_prenotazione']);
        $prenotazione = $this->prenotazioneService->update($id, $data);
        return response()->json($prenotazione);
    }
}
