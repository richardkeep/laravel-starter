<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageUserController extends Controller
{
    private $userService;
    private $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index()
    {
        $users = $this->userService->getUsersAdmin();

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
            'submit_url' => route('manage.user.save'),
            'roles' => $this->roleService->getRoles(Auth::user()),
        ]);
    }

    public function store(Request $request)
    {
        $postData = $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|exists:roles,id',
        ]);

        $user = $this->userService->createUser(Auth::user(), $postData);

        auditEvent(Auth::user()->name . " created a new user {$user->name} with id {$user->id}");

        return redirect()
            ->route('manage.user')
            ->with('success', 'User created');
    }
}
