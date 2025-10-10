<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto;

class AmministratoreController extends Controller
{
    public function index()
    {
        return view('amministratore.dashboard');
    }

    public function searchProdotti()
    {
        return view('amministratore.searchProdotti');
    }

    public function gestioneProdotti(Request $request)
    {
        $prodotti = Prodotto::all();

        return view('amministratore.gestioneProdotti', compact('prodotti'));
    }
}
