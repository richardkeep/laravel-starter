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

    public function createUser(User $loggedInUser, array $postData)
    {
        $role = Role::findOrFail($postData['role']);

        if ($role->name === 'super_admin' && !$loggedInUser->hasRole('super_admin')) {
            abort(403, config('messages.user.create.not_allowed_role'));
        }

        return User::create([
            'name' => $postData['name'],
            'email' => $postData['email'],
            'password' => bcrypt($postData['password']),
        ])->assignRole($role->name);
    }

    public function updateUser(User $loggedInUser, array $postData)
    {
        $role = Role::findOrFail($postData['role']);

        if ($role->name === 'super_admin' && !$loggedInUser->hasRole('super_admin')) {
            abort(403, config('messages.user.update.not_allowed_role'));
        }

        $user = User::find($postData['id']);
        $user->name = $postData['name'];
        $user->save();

        $role = Role::find($postData['role']);
        $user->syncRoles($role->name);

        return $user;
    }
}
