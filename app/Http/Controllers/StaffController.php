<?php

namespace App\Http\Controllers;

use App\Services\PrenotazioneService;
use App\Services\PrestazioneService;
use App\Http\Requests\ModificaSlotRequest;
use App\Services\AgendaService;
use App\Services\NotificaService;
use Illuminate\View\View;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected PrenotazioneService $prenotazioneService;
    protected PrestazioneService $prestazioneService;
    protected NotificaService $notificaService;
    protected AgendaService $agendaService;

    public function __construct(PrenotazioneService $prenotazioneService, NotificaService $notificaService, AgendaService $agendaService, PrestazioneService $prestazioneService)
    {
        $this->prestazioneService = $prestazioneService;
        $this->prenotazioneService = $prenotazioneService;
        $this->notificaService = $notificaService;
        $this->agendaService = $agendaService;
    }

    public function index(): View
    {
        return view('staff.dashboard');
    }

    public function prenotazioni(): View
    {
        $prenotazioni = $this->prenotazioneService->getByStaffId(auth()->id());
        return view('staff.prenotazioni', compact('prenotazioni'));
    }

    public function prenotazioniPrestazione(string $id): View
    {
        $prenotazioni = $this->prenotazioneService->getPrenotazioniByPrestazioneIdAndFromToday($id);
        return view('staff.prenotazioni_prestazione', compact('prenotazioni'));
    }

    public function prestazioni(): View
    {
        $prestazioni = $this->prestazioneService->getAll();
        return view('staff.prestazioni', compact('prestazioni'));
    }

    public function getSlot(int $prenotazioneId): View
    {
        $prenotazione = $this->prenotazioneService->getById($prenotazioneId);
        $data = $this->agendaService->getSlot($prenotazione->prestazione->id);

        return view('staff.prestazioni_agenda', [
            'prenotazioneId' => $prenotazioneId,
            'giornoEscluso' => $prenotazione->giorno_escluso,
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
    }

    public function updatePrenotazione(ModificaSlotRequest $request, string $id)
    {
        $data = $request->only(['data_prenotazione']);
        $prenotazione = $this->prenotazioneService->update($id, $data);

        $this->notificaService->create([
            'user_id' => $prenotazione->user->id,
            'prenotazione_id' => $prenotazione->id,
            'action' => 'modified'
        ]);
    }

    public function deletePrenotazione(string $prenotazioneId)
    {
        $prenotazione = $this->prenotazioneService->getById($prenotazioneId);

        $this->agendaService->deleteGiornalieraByPrenotazioneId($prenotazioneId);

        $this->prenotazioneService->delete($prenotazioneId);

        $this->notificaService->create([
            'user_id' => $prenotazione->user->id,
            'prenotazione_id' => $prenotazione->id,
            'action' => 'deleted'
        ]);
    }
}
