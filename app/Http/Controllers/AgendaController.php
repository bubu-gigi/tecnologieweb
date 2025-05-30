<?php

namespace App\Http\Controllers;

use App\Services\AgendaService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaController extends Controller
{
    protected AgendaService $agendaService;

    public function __construct(AgendaService $agendaService)
    {
        $this->agendaService = $agendaService;
    }

    public function getTemplate(int $prestazioneId): JsonResponse
    {
        $data = $this->agendaService->getAgendaTemplateByPrestazione($prestazioneId);
        return response()->json(['success' => true, 'data' => $data]);
    }
    
    public function getSlotDisponibilitaGiugno(int $prestazioneId): View
    {
        $data = $this->agendaService->getSlotDisponibilitaGiugno($prestazioneId);

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
}
