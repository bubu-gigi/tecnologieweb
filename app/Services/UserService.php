<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAll(): Collection
    {
        return User::all();
    }

    public function getById(string $id): User
    {
        return User::findOrFail($id);
    }

    public function getByRuolo(string $ruolo): Collection
    {
        return User::where('ruolo', $ruolo)->get();
    }

    public function getByUsername(string $username)
    {
        return User::where('username', $username)->first();
    }

    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function update(string $id, array $data): User
    {
        $user = User::findOrFail($id);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function delete(string $id): int
    {
        return User::destroy($id);
    }
}
