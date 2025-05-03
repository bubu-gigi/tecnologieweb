<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function getAll(): Collection
    {
        return User::all();
    }

    public function getById(string $id): User
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(string $id, array $data): User
    {
        $dip = User::findOrFail($id);
        $dip->update($data);
        return $dip;
    }

    public function delete(string $id): int
    {
        return User::destroy($id);
    }
}
