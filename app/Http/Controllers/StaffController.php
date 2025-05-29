<?php

namespace App\Http\Controllers;

use App\Services\PrenotazioneService;
use Illuminate\View\View;

class StaffController extends Controller
{
    protected PrenotazioneService $prenotazioneService;

    public function __construct(PrenotazioneService $prenotazioneService)
    {
        $this->prenotazioneService = $prenotazioneService;
    }

    public function index(): View
    {
        return view('staff.dashboard');
    }
    
    public function prenotazioni(): View
    {
        $prenotazioni = $this->prenotazioneService->getAll();
        return view('staff.prenotazioni', compact('prenotazioni'));
    }

    

}
