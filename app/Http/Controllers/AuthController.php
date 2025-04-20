<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = $this->authService->login($request->only('username', 'password'));

        if($user === null) {
            return response()->json([
                'message' => 'Credenziali non valide',
            ], 401);
        }
        return response()->json($user);
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return response()->json(['message' => 'Logout effettuato con successo']);
    }

    public function me(): JsonResponse
    {
        $user = $this->authService->getUser();

        return response()->json($user);
    }
}
