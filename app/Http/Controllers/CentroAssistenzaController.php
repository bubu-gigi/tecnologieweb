<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentroAssistenza;

class CentroAssistenzaController extends Controller
{
    public function index()
    {
        $centri = CentroAssistenza::all();
        return view('amministratore.gestioneCentri', compact('centri'));
    }

    public function create()
    {
        return view('amministratore.centriForm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'indirizzo' => 'required|string|max:255',
        ]);

        CentroAssistenza::create([
            'nome' => $request->nome,
            'indirizzo' => $request->indirizzo,
        ]);

        return redirect()->route('amministratore.centri.index')
            ->with('success', 'Centro assistenza aggiunto correttamente.');
    }

    public function edit($id)
    {
        $centro = CentroAssistenza::findOrFail($id);
        return view('amministratore.centriForm', compact('centro'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'indirizzo' => 'required|string|max:255',
        ]);

        $centro = CentroAssistenza::findOrFail($id);
        $centro->update([
            'nome' => $request->nome,
            'indirizzo' => $request->indirizzo,
        ]);

        return redirect()->route('amministratore.centri.index')
            ->with('success', 'Centro assistenza aggiornato correttamente.');
    }

    public function destroy($id)
    {
        $centro = CentroAssistenza::findOrFail($id);
        $centro->delete();

        return response()->json([
            'success' => true,
            'message' => 'Centro assistenza eliminato correttamente.'
        ]);
    }
}