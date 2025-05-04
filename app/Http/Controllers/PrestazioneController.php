<?php

namespace App\Http\Controllers;

use App\Services\PrestazioneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrestazioneController extends Controller
{
    protected PrestazioneService $prestazioneService;

    public function __construct(PrestazioneService $prestazioneService)
    {
        $this->prestazioneService = $prestazioneService;
    }

    public function index(): JsonResponse
    {
        $prestazioni = $this->prestazioneService->getAll();
        return response()->json($prestazioni);
    }

    public function show(string $id): JsonResponse
    {
        $prestazione = $this->prestazioneService->getById($id);
        return response()->json($prestazione);
    }

    public function search(Request $request): View
    {
        $prestazione = $request->input('prestazione');
        $dipartimento = $request->input('dipartimento');

        if ($prestazione) {
            $prestazioni = $this->prestazioneService->searchByPrestazione($prestazione);
        } elseif ($dipartimento) {
            $prestazioni = $this->prestazioneService->searchByDipartimento($dipartimento);
        }

        return view('customers.prestazione', compact('prestazioni'));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->only(keys: ['descrizione', 'prescrizioni', 'medico_id']);
        $prestazione = $this->prestazioneService->create($data);

        return response()->json($prestazione, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $data = $request->only(keys: ['descrizione', 'prescrizioni', 'medico_id']);
        $prestazione = $this->prestazioneService->update($id, $data);
        return response()->json($prestazione);
    }

    public function destroy(string $id): JsonResponse
    {
        $prestazione = $this->prestazioneService->delete($id);
        return response()->json($prestazione);
    }
}
