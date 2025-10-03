<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto;

class TecnicoAssistenzaController extends Controller
{
    public function searchProdotti(Request $request)
    {
        $query = Prodotto::query();

        if ($request->filled('q')) {
            $term = $request->q;

            if (str_ends_with($term, '*')) {
                $term = rtrim($term, '*');
                $query->where('descrizione', 'like', $term . '%');
            } else {
                $query->where('descrizione', 'like', '%' . $term . '%');
            }
        }

        $prodotti = $query->orderBy('name')->get();
        return response()->json(['prodotti' => $prodotti]);
    }

    public function showProdotto($id)
    {
        $prodotto = Prodotto::with('malfunzionamenti')->findOrFail($id);

        return view('tecnicoAssistenza.prodotto_dettaglio', compact('prodotto'));
    }
}
