<?php

namespace App\Services;

use App\User;
use Spatie\Permission\Models\Role;

class UserService
{
    public function getUsersAdmin()
    {
        return User::query()
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function createUser(User $user, array $postData)
    {
        $role = Role::findOrFail($postData['role']);

        if ($role->name === 'super_admin' && !$user->hasRole('super_admin')) {
            abort(403, config('messages.user.create.not_allowed_role'));
        }

        return User::create([
            'name' => $postData['name'],
            'email' => $postData['email'],
            'password' => bcrypt($postData['password']),
        ])->assignRole($role->name);
    }
}
