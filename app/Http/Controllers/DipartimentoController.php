<?php

namespace App\Http\Controllers;

use App\Services\DipartimentoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DipartimentoController extends Controller
{
    protected DipartimentoService $dipartimentoService;

    public function __construct(DipartimentoService $dipartimentoService)
    {
        $this->dipartimentoService = $dipartimentoService;
    }

    public function showAll(): JsonResponse
    {
        $dipartimenti = $this->dipartimentoService->getAll();
        return response()->json($dipartimenti);
    }

    public function show(string $id): JsonResponse
    {
        $dipartimento = $this->dipartimentoService->getById($id);
        return response()->json($dipartimento);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->only(['nome', 'descrizione']);
        $dipartimento = $this->dipartimentoService->create($data);

        return response()->json($dipartimento, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $data = $request->only(['nome', 'descrizione']);
        $dipartimento = $this->dipartimentoService->update($id, $data);
        return response()->json($dipartimento);
    }

    public function delete(string $id): JsonResponse
    {
        $dipartimento = $this->dipartimentoService->delete($id);
        return response()->json($dipartimento);
    }
}
