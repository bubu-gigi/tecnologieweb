<?php

namespace App\Http\Controllers;

use App\Services\MedicoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    protected MedicoService $medicoService;

    public function __construct(MedicoService $medicoService)
    {
        $this->medicoService = $medicoService;
    }

    public function index(): JsonResponse
    {
        $medici = $this->medicoService->getAll();
        return response()->json($medici);
    }

    public function show(string $id): JsonResponse
    {
        $medico = $this->medicoService->getById($id);
        return response()->json($medico);
    }
    /**
     *   'nome',
        'cognome',
        'eta',
        'telefono',
        'email',
        'specializzazione',
        'dipartimento_id',
     */

    public function store(Request $request): JsonResponse
    {
        $data = $request->only(keys: ['nome', 'cognome', 'eta', 'telefono', 'email', 'specializzazione', 'dipartimento_id']);
        $medico = $this->medicoService->create($data);

        return response()->json($medico, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $data = $request->only(keys: ['nome', 'cognome', 'eta', 'telefono', 'email', 'specializzazione', 'dipartimento_id']);
        $medico = $this->medicoService->update($id, $data);
        return response()->json($medico);
    }

    public function destroy(string $id): JsonResponse
    {
        $medico = $this->medicoService->delete($id);
        return response()->json($medico);
    }
}
