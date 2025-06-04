<?php

namespace App\Http\Controllers;

use App\Services\PrenotazioneService;
use App\Services\NotificationService;
use App\Http\Requests\ModificaSlotRequest;
use App\Services\AgendaService;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StaffController extends Controller
{
    protected PrenotazioneService $prenotazioneService;
    protected NotificationService $notificationService;
    protected AgendaService $agendaService;

    public function __construct(PrenotazioneService $prenotazioneService, NotificationService $notificationService, AgendaService $agendaService)
    {
        $this->prenotazioneService = $prenotazioneService;
        $this->notificationService = $notificationService;
        $this->agendaService = $agendaService;
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

    public function assegnaSlot(Request $request, object $slot): JsonResponse
    {
        $ok = $this->agendaService->assegnaSlot($slot['prenotazione_id'], Carbon::parse($request->input('data')), $slot['orario']);

        if (!$ok) {
            return response()->json(['success' => false, 'message' => 'Slot non disponibile'], 409);
        }

        return response()->json(['success' => true, 'message' => 'Slot assegnato']);
    }

    public function updatePrenotazione(ModificaSlotRequest $request, string $id): JsonResponse
    {
        $data = $request->only(['data_prenotazione']);
        $prenotazione = $this->prenotazioneService->update($id, $data);

        $this->notificationService->create([
            'user_id' => $prenotazione->user_id,
            'prenotazione_id' => $prenotazione->id,
            'action' => 'modified'
        ]);

        return response()->json($prenotazione);
    }

    public function destroyPrenotazione(string $id): JsonResponse
    {
        $prenotazione = $this->prenotazioneService->getById($id);
        if(!$prenotazione) {
            return response()->json( 404);
        }
        $this->prenotazioneService->delete($id);

        $this->notificationService->create([
            'user_id' => $prenotazione->user_id,
            'prenotazione_id' => $prenotazione->id,
            'action' => 'deleted'
        ]);

        return response()->json(null, 204);
    }
}
