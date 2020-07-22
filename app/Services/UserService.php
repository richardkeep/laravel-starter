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
}
