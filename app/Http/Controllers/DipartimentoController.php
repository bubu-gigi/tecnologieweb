<?php

namespace App\Http\Controllers;

use App\Services\DipartimentoService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\GestioneDipartimentiRequest;

class DipartimentoController extends Controller
{
    protected DipartimentoService $dipartimentoService;

    public function __construct(DipartimentoService $dipartimentoService)
    {
        $this->dipartimentoService = $dipartimentoService;
    }

    public function index(): JsonResponse
    {
        $dipartimenti = $this->dipartimentoService->getAll();
        return response()->json($dipartimenti);
    }

    public function showPage(string $id)
    {
        $dipartimento = $this->dipartimentoService->getById($id);

        if (!$dipartimento) {
            abort(404, 'Dipartimento non trovato');
        }

        return view('customers.dipartimento', compact('dipartimento'));
    }


    public function show(string $id): JsonResponse
    {
        $dipartimento = $this->dipartimentoService->getById($id);
        return response()->json($dipartimento);
    }

    public function store(GestioneDipartimentiRequest $request): JsonResponse
    {
        $data = $request->validated();
        $dipartimento = $this->dipartimentoService->create($data);

        return response()->json($dipartimento, 201);
    }

    public function update(GestioneDipartimentiRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $dipartimento = $this->dipartimentoService->update($id, $data);

        return response()->json($dipartimento);
    }

    public function destroy(string $id): JsonResponse
    {
        $dipartimento = $this->dipartimentoService->delete($id);
        return response()->json($dipartimento);
    }
}
