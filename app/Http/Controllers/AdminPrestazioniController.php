<?php

namespace App\Http\Controllers;

use App\Models\Prestazione;
use Illuminate\Http\Request;

class AdminPrestazioniController extends Controller
{
    //Le varie funzioni per mettere,creare e modificare

    public function index()
    {
        $prestazioni = Prestazione::all();
        return view('admin.prestazioni.index', compact('prestazioni'));
    }

    public function create()
    {
        return view('admin.prestazioni.form', ['prestazione' => new Prestazione()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titolo' => 'required|string|max:255',
            'dipartimento' => 'required|string|max:255',
            'giorno' => 'required|string',
            'fascia_oraria' => 'required|string',
        ]);

        Prestazione::create($data);
        return redirect()->route('admin.prestazioni.index');
    }

    public function edit($id)
    {
        $prestazione = Prestazione::findOrFail($id);
        return view('admin.prestazioni.form', compact('prestazione'));
    }

    public function update(Request $request, $id)
    {
        $prestazione = Prestazione::findOrFail($id);

        $data = $request->validate([
            'titolo' => 'required|string|max:255',
            'dipartimento' => 'required|string|max:255',
            'giorno' => 'required|string',
            'fascia_oraria' => 'required|string',
        ]);
        // Aggiorna i dati della prestazione
        $prestazione->update($data);
        // Reindirizza alla lista delle prestazioni
        return redirect()->route('admin.prestazioni.index');
    }

    public function destroy($id)
    {
        $prestazione = Prestazione::findOrFail($id);
        $prestazione->delete();
        return redirect()->route('admin.prestazioni.index');
    }

}