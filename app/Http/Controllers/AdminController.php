<?php

namespace App\Http\Controllers;

use App\Services\DipartimentoService;
use App\Services\UserService;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\GestioneDipartimentiRequest;

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


    public function createUser(): View
    {
        return view('admin.utenti.create');
    }

    public function editUser($id): View
    {
        $user = $this->userService->getById($id);
        return view('admin.utenti.edit', data: compact('user'));
    }

    public function users(): View
    {
        $users = $this->userService->getByRuolo('staff');
        return view('admin.utenti', compact('users'));
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
}
