<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\View\View;

class AdminController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
}
