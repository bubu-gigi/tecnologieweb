<?php

namespace App\Http\Controllers;

use App\Services\PrenotazioneService;
use App\Services\NotificationService;
use App\Http\Requests\ModificaSlotRequest;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StaffController extends Controller
{
    protected PrenotazioneService $prenotazioneService;
    private NotificationService $notificationService;

    public function __construct(PrenotazioneService $prenotazioneService, NotificationService $notificationService) 
    {
        $this->prenotazioneService = $prenotazioneService;
        $this->notificationService = $notificationService;
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

    public function updatePrenotazione(ModificaSlotRequest $request, string $id): JsonResponse
    {
        $data = $request->only(['data_prenotazione']);
        $prenotazione = $this->prenotazioneService->update($id, $data);

        $this->notificationService->creaNotifica(
            userId: $prenotazione->user_id,
            prenotazioneId: $prenotazione->id,
            azione: 'modified',
            descrizione: 'La data della tua prenotazione è stata modificata dallo staff.'
        );

        return response()->json($prenotazione);
    }

    public function destroyPrenotazione(string $prenotazione): JsonResponse
    {
        $this->prenotazioneService->delete($prenotazione);

        $this->notificationService->creaNotifica(
            userId: $prenotazioneModel->user_id,
            prenotazioneId: $prenotazioneModel->id,
            azione: 'deleted',
            descrizione: 'La tua prenotazione è stata cancellata dallo staff.'
        );

        return response()->json(null, 204);
    }
}
