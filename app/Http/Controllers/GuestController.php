<?php

namespace App\Http\Controllers;

use App\Models\CentroAssistenza;
use App\Models\Prodotto;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function index(): View
    {
        $prodotti = Prodotto::all();
        $centri_assistenza = CentroAssistenza::all();
        return view('welcome', compact('prodotti', 'centri_assistenza'));
    }
}
