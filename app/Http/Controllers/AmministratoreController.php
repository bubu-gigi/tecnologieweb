<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto;
use App\Models\User;
use App\Models\CentroAssistenza;

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

    public function createProdotto()
    {
        return view('amministratore.prodottoForm');
    }

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

    public function editProdotto($id)
    {
        $prodotto = Prodotto::findOrFail($id);
        return view('amministratore.prodottoForm', compact('prodotto'));
    }

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

    public function deleteProdotto($id)
    {
        $prodotto = Prodotto::findOrFail($id);
        $prodotto->delete();

        return response()->json(['success' => true]);
    }

    public function gestioneUtenti()
    {
        return view('amministratore.gestioneUtenti');
    }

    // ============================================
    // 🟧 SEZIONE GESTIONE TECNICI ASSISTENZA (LVL 2)
    // ============================================

    public function gestioneTecniciAssistenza()
    {
        $tecnici = User::where('ruolo', 'tecnico_assistenza')
                        ->with('centroAssistenza')
                        ->get();

        return view('amministratore.gestioneTecniciAssistenza', compact('tecnici'));
    }

    public function createTecnicoAssistenza()
    {
        $centri = CentroAssistenza::all();
        return view('amministratore.tecniciAssistenzaForm', compact('centri'));
    }

    public function storeTecnicoAssistenza(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'data_nascita' => 'required|date',
            'specializzazione' => 'nullable|string|max:255',
            'centro_assistenza_id' => 'required|exists:centri_assistenza,id',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ]);

        $data['password'] = $data['password']; // visibile in chiaro
        $data['ruolo'] = 'tecnico_assistenza';

        User::create($data);

        return redirect()
            ->route('amministratore.gestioneTecniciAssistenza')
            ->with('success', 'Tecnico creato correttamente.');
    }

    public function editTecnicoAssistenza($id)
    {
        $tecnico = User::where('ruolo', 'tecnico_assistenza')->findOrFail($id);
        $centri = CentroAssistenza::all();
        return view('amministratore.tecniciAssistenzaForm', compact('tecnico', 'centri'));
    }

    public function updateTecnicoAssistenza(Request $request, $id)
    {
        $tecnico = User::where('ruolo', 'tecnico_assistenza')->findOrFail($id);

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'data_nascita' => 'required|date',
            'specializzazione' => 'nullable|string|max:255',
            'centro_assistenza_id' => 'required|exists:centri_assistenza,id',
            'username' => 'required|string|max:255|unique:users,username,' . $tecnico->id,
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = $data['password']; // visibile in chiaro
        } else {
            unset($data['password']);
        }

        $tecnico->update($data);

        return redirect()
            ->route('amministratore.gestioneTecniciAssistenza')
            ->with('success', 'Tecnico aggiornato correttamente.');
    }

    public function deleteTecnicoAssistenza($id)
    {
        $tecnico = User::where('ruolo', 'tecnico_assistenza')->findOrFail($id);
        $tecnico->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tecnico eliminato correttamente.'
        ]);
    }
}
