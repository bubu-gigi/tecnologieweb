<?php

namespace App\Http\Controllers;

use App\Services\DipartimentoService;
use App\Services\UserService;
use Illuminate\View\View;

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

}
