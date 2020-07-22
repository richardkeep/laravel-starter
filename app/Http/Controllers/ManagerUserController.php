<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class ManagerUserController extends Controller
{
    public function index(UserService $userService)
    {
        $users = $userService->getUsersAdmin();

        return view('admin.user-listing', [
            'users' => $users,
        ]);
    }
}
