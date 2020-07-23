<?php

namespace Tests\Unit;

use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class RoleServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_gives_super_admin_role_to_super_admin()
    {
        $user = $this->createUserWithRole('super_admin');

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $roleService = new RoleService;
        $roles = $roleService->getRoles($user);

        $check = $roles->where('name', 'super_admin');
        $this->assertEquals(1, $check->count());
    }

    /** @test */
    public function it_does_not_show_super_admin_for_other_roles()
    {
        $user = $this->createUserWithRole('broker');

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $roleService = new RoleService;
        $roles = $roleService->getRoles($user);

        $check = $roles->where('name', 'super_admin');
        $this->assertEquals(0, $check->count());
    }

    /** @test */
    public function it_creates_a_user()
    {
        $user = $this->createUserWithRole('super_admin');
        Role::create(['name' => 'user']);

        $postData = [
            'name' => 'Jhon Doe',
            'email' => 'jhon.doe@nmail.com',
            'password' => 'password',
            'role' => 2,
        ];

        $userService = new UserService;
        $newUser = $userService->createUser($user, $postData);

        $this->assertEquals($postData['name'], $newUser->name);
    }

    /** @test */
    public function it_assigns_correct_role()
    {
        $user = $this->createUserWithRole('super_admin');
        $role = Role::create(['name' => 'user']);

        $postData = [
            'name' => 'Jhon Doe',
            'email' => 'jhon.doe@nmail.com',
            'password' => 'password',
            'role' => 2,
        ];

        $userService = new UserService;
        $newUser = $userService->createUser($user, $postData);

        $this->assertEquals($role->name, $newUser->roles->first()->name);
    }

    /** @test */
    public function non_super_admin_cannot_create_super_admin()
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage(config('messages.user.create.not_allowed_role'));

        Role::create(['name' => 'super_admin']);
        $user = $this->createUserWithRole('admin');

        $postData = [
            'name' => 'Jhon Doe',
            'email' => 'jhon.doe@nmail.com',
            'password' => 'password',
            'role' => 1,
        ];

        $userService = new UserService;
        $userService->createUser($user, $postData);
    }

    /** @test */
    public function it_fails_if_role_not_found()
    {
        $this->expectException(ModelNotFoundException::class);
        $user = $this->createUserWithRole('admin');

        $postData = [
            'name' => 'Jhon Doe',
            'email' => 'jhon.doe@nmail.com',
            'password' => 'password',
            'role' => 9,
        ];

        $userService = new UserService;
        $userService->createUser($user, $postData);
    }
}
