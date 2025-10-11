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

    public function gestioneProdotti()
    {
        $prodotti = Prodotto::all();
        return view('amministratore.gestioneProdotti', compact('prodotti'));
    }

    // 🟧 Mostra form per creare un nuovo prodotto
    public function createProdotto()
    {
        return view('amministratore.prodottoForm');
    }

    // 🟧 Salva nuovo prodotto
    public function storeProdotto(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'descrizione' => 'required|string',
            'note_uso' => 'nullable|string',
            'mod_installazione' => 'nullable|string',
        ]);

        Prodotto::create($validated);

        return redirect()->route('amministratore.gestioneProdotti')
            ->with('success', 'Prodotto aggiunto con successo.');
    }

    // 🟧 Mostra form di modifica
    public function editProdotto($id)
    {
        $prodotto = Prodotto::findOrFail($id);
        return view('amministratore.prodottoForm', compact('prodotto'));
    }

    // 🟧 Aggiorna prodotto
    public function updateProdotto(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'descrizione' => 'required|string',
            'note_uso' => 'nullable|string',
            'mod_installazione' => 'nullable|string',
        ]);

        $prodotto = Prodotto::findOrFail($id);
        $prodotto->update($validated);

        return redirect()->route('amministratore.gestioneProdotti')
            ->with('success', 'Prodotto aggiornato correttamente.');
    }

    // 🟧 Elimina prodotto
    public function deleteProdotto($id)
    {
        $prodotto = Prodotto::findOrFail($id);
        $prodotto->delete();

        return response()->json(['success' => true]);
    }
}
