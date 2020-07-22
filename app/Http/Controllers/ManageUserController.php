<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index(UserService $userService)
    {
        $users = $userService->getUsersAdmin();

        return view('admin.user-listing', [
            'users' => $users,
        ]);
    }

    public function view(User $user)
    {
        return $user;
    }

    public function add()
    {
        return view('admin.user-add', [
            'submit_url' => route('manage.user.save')
        ]);
    }

    public function store(Request $request, UserService $userService)
    {
        $postData = $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $userService->createUser($postData);

        return redirect()
            ->route('manage.user')
            ->with('success', 'User created');
    }
}
