<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto;
use App\Models\Malfunzionamento;
use App\Http\Requests\MalfunzionamentoRequest;

class TecnicoAziendaController extends Controller
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

        return view('tecnicoAzienda.prodotto_dettaglio', compact('prodotto'));
    }

    public function deleteMalfunzionamento($id) {
        Malfunzionamento::where('id', $id)->delete();
    }

    public function createMalfunzionamento(MalfunzionamentoRequest $request) {
         $malfunzionamento = Malfunzionamento::create([
            'descrizione' => $request->descrizione,
            'soluzione_tecnica' => $request->soluzione_tecnica,
        ]);

        return redirect()
            ->route('tecnicoAzienda.prodotto_dettaglio');
    }
}
