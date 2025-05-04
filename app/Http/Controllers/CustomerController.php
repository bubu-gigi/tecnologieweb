<?php

namespace App\Http\Controllers;

use App\Services\PrenotazioneService;
use Illuminate\View\View;

class CustomerController extends Controller
{
    protected PrenotazioneService $prenotazioneService;

    public function __construct(PrenotazioneService $prenotazioneService)
    {
        $this->prenotazioneService = $prenotazioneService;
    }

    public function index(): View
    {
        return view('customers.dashboard');
    }

    public function prestazioni(): View
    {
        return view('customers.prestazione');
    }

    public function prenotazioni(): View
    {
        $user = auth()->user();
        $prenotazioni = $this->prenotazioneService->getPrenotazioniByUserId($user->id);
        return view('customers.prenotazioni', compact('prenotazioni'));
    }
}
