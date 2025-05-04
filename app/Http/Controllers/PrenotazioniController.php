<?php

namespace App\Http\Controllers;

use App\Services\PrenotazioneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrenotazioniController extends Controller
{
    protected PrenotazioneService $prenotazioneService;

    public function __construct(PrenotazioneService $prenotazioneService)
    {
        $this->prenotazioneService = $prenotazioneService;
    }

    public function index(): JsonResponse
    {
        $prenotazione = $this->prenotazioneService->getAll();
        return response()->json($prenotazione);
    }

    public function show(string $id): JsonResponse
    {
        $prenotazione = $this->prenotazioneService->getById($id);
        return response()->json($prenotazione);
    }


    public function store(Request $request): JsonResponse
    {
        $data = $request->only(keys: ['user_id', 'prestazione_id', 'giorno_escluso', 'data_prenotazione']);
        $prenotazione = $this->prenotazioneService->create($data);

        return response()->json($prenotazione, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $data = $request->only(keys: ['user_id', 'prestazione_id', 'giorno_escluso', 'data_prenotazione']);
        $prenotazione = $this->prenotazioneService->update($id, $data);
        return response()->json($prenotazione);
    }

    public function destroy(string $id): JsonResponse
    {
        $prenotazione = $this->prenotazioneService->delete($id);
        return response()->json($prenotazione);
    }
}
