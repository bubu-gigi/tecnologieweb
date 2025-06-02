<?php

namespace App\Http\Controllers;

use App\Services\DipartimentoService;
use App\Services\PrestazioneService;
use App\Services\UserService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SearchPrestazioneRequest;
use App\Http\Requests\SearchDipartimentoRequest;
use App\Http\Requests\GestioneDipartimentiRequest;
use App\Http\Requests\GestioneUtentiRequest;

class AdminController extends Controller
{
    protected UserService $userService;

    protected DipartimentoService $dipartimentoService;

    public function __construct(UserService $userService, DipartimentoService $dipartimentoService)
    {
        $this->userService = $userService;
        $this->dipartimentoService = $dipartimentoService;
    }

    public function index(): View
    {
        return view('admin.dashboard');
    }

    public function users(): View
    {
        session(['previous_url' => url()->current()]);

        $users = $this->userService->getByRuolo('staff');
        return view('admin.utenti', compact('users'));
    }

    public function createUser(): View
    {
        return view('admin.utenti.create');
    }

    public function editUser($id): View
    {
        $user = $this->userService->getById($id);
        return view('admin.utenti.edit', data: compact('user'));
    }

    public function storeUser(GestioneUtentiRequest $request)
    {
        $data = $request->validated();
        $data['ruolo'] = 'staff';
        $this->userService->create($data);

        return redirect()->route('admin.users')->with('success', 'Utente creato con successo.');
    }

    public function updateUser(GestioneUtentiRequest $request, string $id)
    {
        $data = $request->validated();
        $this->userService->update($id, $data);

        return redirect()->route('admin.users')->with('success', 'Utente aggiornato con successo.');
    }

    public function deleteUser(string $id)
    {
        $this->userService->delete($id);
    }

    public function dipartimenti()
    {
        $dipartimenti = $this->dipartimentoService->getAll();
        return view('admin.dipartimenti', compact('dipartimenti'));
    }

    public function createDipartimento(): View
    {
        return view('admin.dipartimenti.create');
    }

    public function editDipartimento(string $id): View
    {
        $dipartimento = $this->dipartimentoService->getById($id);
        return view('admin.dipartimenti.edit', data: compact('dipartimento'));
    }

    public function storeDipartimento(GestioneDipartimentiRequest $request)
    {
        $data = $request->validated();
        $this->dipartimentoService->create($data);

        return redirect()->route('admin.dipartimenti')->with('success', 'Dipartimento creato con successo.');
    }

    public function updateDipartimento(GestioneDipartimentiRequest $request, string $id)
    {
        $data = $request->validated();
        $this->dipartimentoService->update($id, $data);

        return redirect()->route('admin.dipartimenti')->with('success', 'Dipartimento aggiornato con successo.');
    }

    public function deleteDipartimento(string $id): JsonResponse
    {
        $deleted = $this->dipartimentoService->delete($id);

        if ($deleted) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Errore durante l\'eliminazione'], 500);
    }

    // gestione prestazioni
    public function indexPrestazioni(): JsonResponse
    {
        $prestazioni = $this->prestazioneService->getAll();
        return response()->json($prestazioni);
    }

    public function show(string $id): JsonResponse
    {
        $prestazione = $this->prestazioneService->getById($id);
        return response()->json($prestazione);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->only(keys: ['descrizione', 'prescrizioni', 'medico_id']);
        $prestazione = $this->prestazioneService->create($data);

        return response()->json($prestazione, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $data = $request->only(keys: ['descrizione', 'prescrizioni', 'medico_id']);
        $prestazione = $this->prestazioneService->update($id, $data);
        return response()->json($prestazione);
    }

    public function destroy(string $id): JsonResponse
    {
        $prestazione = $this->prestazioneService->delete($id);
        return response()->json($prestazione);
    }
}
