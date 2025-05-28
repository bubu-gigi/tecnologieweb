<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestazione;
use App\Models\Dipartimento;
use App\Models\Utente;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminStatisticheController extends Controller
{
    public function index()
    {
    // Esempio di statiche

        $totalPrestazioni = Prestazione::count();
        $totalUtenti = User::count();

        $prestazioniPerDipartimento = Prestazione::select('dipartimento', DB::raw('count(*) as total'))
            ->groupBy('dipartimento')
            ->get();

        return view('admin.statistiche.index', compact('totalPrestazioni', 'totalDipartimenti', 'totalUtenti', 'prestazioniPerDipartimento'));
    }
}
