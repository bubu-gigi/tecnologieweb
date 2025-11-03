<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto;
use App\Models\User;
use App\Models\CentroAssistenza;
use App\Http\Requests\ProdottoRequest;

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
        $staff = User::where('ruolo', 'tecnico_azienda')->get();
        return view('amministratore.prodottoForm', compact('staff'));
    }

    public function storeProdotto(ProdottoRequest $request)
    {
        Prodotto::create($request->validated());

        return redirect()->route('amministratore.gestioneProdotti')
            ->with('success', 'Prodotto aggiunto con successo.');
    }

    public function editProdotto($id)
    {
        $prodotto = Prodotto::findOrFail($id);
        $staff = User::where('ruolo', 'tecnico_azienda')->get();
        return view('amministratore.prodottoForm', compact('staff', 'prodotto'));
    }

    public function updateProdotto(ProdottoRequest $request, $id)
    {

        $prodotto = Prodotto::findOrFail($id);
        $prodotto->update($request->validated());

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

    public function gestioneTecniciAssistenza()
    {
        $tecnici = User::where('ruolo', 'tecnico_assistenza')->with('centroAssistenza')->get();
        return view('amministratore.gestioneTecniciAssistenza', compact('tecnici'));
    }

    public function createTecnicoAssistenza()
    {
        $centri = CentroAssistenza::all();
        return view('amministratore.tecniciAssistenzaForm', compact('centri'));
    }

    public function storeTecnicoAssistenza(TecnicoAssistenzaRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $data['ruolo'] = 'tecnico_assistenza';

        User::create($data);

        return redirect()->route('amministratore.gestioneTecniciAssistenza')
            ->with('success', 'Tecnico creato correttamente.');
    }

    public function editTecnicoAssistenza($id)
    {
        $tecnico = User::where('ruolo', 'tecnico_assistenza')->findOrFail($id);
        $centri = CentroAssistenza::all();
        return view('amministratore.tecniciAssistenzaForm', compact('tecnico', 'centri'));
    }

    public function updateTecnicoAssistenza(TecnicoAssistenzaRequest $request, $id)
    {
        $tecnico = User::where('ruolo', 'tecnico_assistenza')->findOrFail($id);
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $tecnico->update($data);

        return redirect()->route('amministratore.gestioneTecniciAssistenza')
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


    public function gestioneTecniciAzienda()
    {
        $staff = User::where('ruolo', 'tecnico_azienda')->get();
        return view('amministratore.gestioneTecniciAzienda', compact('staff'));
    }

    public function createTecnicoAzienda()
    {
        $staff = collect();
        return view('amministratore.tecniciAziendaForm');
    }

    public function storeTecnicoAzienda(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['ruolo'] = 'tecnico_azienda';

        User::create($data);

        return redirect()->route('amministratore.gestioneTecniciAzienda')
            ->with('success', 'Membro dello staff creato correttamente.');
    }

    public function editTecnicoAzienda($id)
    {
        $membro = User::where('ruolo', 'tecnico_azienda')->findOrFail($id);
        return view('amministratore.tecniciAziendaForm', compact('membro'));
    }

    public function updateTecnicoAzienda(Request $request, $id)
    {
        $tecnico = User::where('ruolo', 'tecnico_azienda')->findOrFail($id);

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $tecnico->id,
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $tecnico->update($data);

        return redirect()->route('amministratore.gestioneTecniciAzienda')
            ->with('success', 'Membro dello staff aggiornato correttamente.');
    }

    public function deleteTecnicoAzienda($id)
    {
        $tecnico = User::where('ruolo', 'tecnico_azienda')->findOrFail($id);
        $tecnico->delete();

        return response()->json([
            'success' => true,
            'message' => 'Membro dello staff eliminato correttamente.'
        ]);
    }
}
