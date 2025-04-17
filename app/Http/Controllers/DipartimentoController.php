<?php

namespace App\Http\Controllers;

use App\Services\DipartimentoService;
use Illuminate\Http\JsonResponse;

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
}
