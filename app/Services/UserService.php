<?php

namespace App\Services;

use App\User;

class UserService
{
    public function getUsersAdmin()
    {
        return User::query()
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function createUser(array $postData)
    {
        return User::create([
            'name' => $postData['name'],
            'email' => $postData['email'],
            'password' => bcrypt($postData['password']),
        ]);
    }
}
