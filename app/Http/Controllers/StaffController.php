<?php

namespace App\Http\Controllers;

use App\Services\PrenotazioneService;
use App\Services\NotificationService;
use App\Services\PrestazioneService;//-------------------------
use App\Http\Requests\ModificaSlotRequest;
use App\Services\AgendaService;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StaffController extends Controller
{
    protected PrenotazioneService $prenotazioneService;
    protected PrestazioneService $prestazioneService;//---------------------
    protected NotificationService $notificationService;
    protected AgendaService $agendaService;

    public function __construct(PrenotazioneService $prenotazioneService, NotificationService $notificationService, AgendaService $agendaService, PrestazioneService $prestazioneService)
    { //----------------------------------------------------------
        $this->prestazioneService = $prestazioneService;
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

    public function prestazioni(): View //--------------------------------
    {
        $prestazioni = $this->prestazioneService->getAll();
        return view('staff.prestazioni', compact('prestazioni'));
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

    public function getSlot(int $prenotazioneId): View
    {
        $prenotazione = $this->prenotazioneService->getById($prenotazioneId);
        $data = $this->agendaService->getSlot($prenotazione->prestazione->id);

        return view('staff.prestazioni_agenda', [
            'prenotazioneId' => $prenotazioneId,
            'prestazione' => $data['prestazione'],
            'slots' => $data['slots'],
        ]);
    }

    public function assegnaSlot(Request $request, int $prenotazioneId)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H',
        ]);

        $this->agendaService->assegnaSlot($prenotazioneId, $request->get('date'), $request->get('time'));

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

    public function deletePrenotazione(string $prenotazioneId): JsonResponse
    {
        $prenotazione = $this->prenotazioneService->getById($prenotazioneId);

        if(!$prenotazione) {
            return response()->json( 404);
        }
        $this->agendaService->deleteGiornalieraByPrenotazioneId($prenotazioneId);

        $this->prenotazioneService->delete($prenotazioneId);

        $this->notificationService->create([
            'user_id' => $prenotazione->user_id,
            'prenotazione_id' => $prenotazione->id,
            'action' => 'deleted'
        ]);

        return response()->json(null, 204);
    }
}
