<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prodotto;
use App\Models\Malfunzionamento;
use App\Http\Requests\MalfunzionamentoRequest;

class TecnicoAziendaController extends Controller
{
    public function searchProdotti(Request $request)
    {
        $search = trim($request->q);
        $userId = Auth::id(); 

        $query = Prodotto::query()
            ->where(function ($q) use ($userId) {
                $q->whereNull('staff_id')
                ->orWhere('staff_id', $userId);
            });

        if ($search) {
            if (str_ends_with($search, '*')) {
                $pattern = rtrim($search, '*') . '%';
                $query->where('descrizione', 'LIKE', $pattern);
            } else {
                $query->where('descrizione', 'LIKE', '%' . $search . '%');
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

    public function deleteMalfunzionamento($id)
    {
        $malfunzionamento = Malfunzionamento::findOrFail($id);
        $malfunzionamento->delete();

        return response()->json([
            'success' => true,
            'message' => 'Malfunzionamento eliminato con successo.'
        ]);
    }

    public function createMalfunzionamento(MalfunzionamentoRequest $request, $id)
    {
        $malfunzionamento = Malfunzionamento::create([
            'descrizione' => $request->descrizione,
            'soluzione_tecnica' => $request->soluzione_tecnica,
            'prodotto_id' => $id,
        ]);

        return redirect()
            ->route('tecnicoAzienda.prodotti.show', ['id' => $id])
            ->with('success', 'Malfunzionamento creato correttamente.');
    }

    public function createFormMalfunzionamento($id)
    {
        return view('tecnicoAzienda.malfunzionamento_form', ['prodotto_id' => $id]);
    }

    public function editMalfunzionamento($id)
    {
        $malfunzionamento = Malfunzionamento::findOrFail($id);
        return view('tecnicoAzienda.malfunzionamento_form', compact('malfunzionamento'));
    }

    public function updateMalfunzionamento(MalfunzionamentoRequest $request, $id)
    {
        $malfunzionamento = Malfunzionamento::findOrFail($id);
        $malfunzionamento->update([
            'descrizione' => $request->descrizione,
            'soluzione_tecnica' => $request->soluzione_tecnica,
        ]);

        return redirect()
            ->route('tecnicoAzienda.prodotti.show', ['id' => $malfunzionamento->prodotto_id])
            ->with('success', 'Malfunzionamento aggiornato correttamente.');
    }
}
