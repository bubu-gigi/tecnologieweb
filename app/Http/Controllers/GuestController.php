<?php

namespace App\Http\Controllers;

use App\Services\DipartimentoService;
use Illuminate\View\View;

class GuestController extends Controller
{
    protected DipartimentoService $dipartimentoService;

    public function __construct(DipartimentoService $dipartimentoService)
    {
        $this->dipartimentoService = $dipartimentoService;
    }
    public function index(): View
    {
        $departments = $this->dipartimentoService->getAll();
        return view('welcome', compact('departments'));
    }
}
