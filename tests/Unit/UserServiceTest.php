<?php

namespace Tests\Unit;

use App\Services\UserService;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

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
    public function it_fails_if_role_not_found_while_creating_user()
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

    /** @test */
    public function it_fails_if_role_not_found_while_updating_user()
    {
        $this->expectException(ModelNotFoundException::class);
        $user = $this->createUserWithRole('super_admin');
        factory(User::class)->create();

        $postData = [
            'id' => 2,
            'name' => 'Jhon Doe',
            'role' => 2,
        ];

        $userService = new UserService;
        $userService->updateUser($user, $postData);
    }

    /** @test */
    public function it_does_not_allow_non_super_admin_to_assign_super_admin_role()
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage(config('messages.user.update.not_allowed_role'));

        Role::create(['name' => 'super_admin']);
        $user = $this->createUserWithRole('admin');
        factory(User::class)->create();

        $postData = [
            'id' => 2,
            'name' => 'Jhon Doe',
            'role' => 1,
        ];

        $userService = new UserService;
        $userService->updateUser($user, $postData);
    }

    /** @test */
    public function it_updates_user_data()
    {
        $user = $this->createUserWithRole('super_admin');
        $newUser = factory(User::class)->create(['name' => 'Jhon Dang']);

        $postData = [
            'id' => $newUser->id,
            'name' => 'Jhon Doe',
            'role' => 1,
        ];

        $userService = new UserService;
        $userService->updateUser($user, $postData);

        $this->assertDatabaseHas('users', [
            'id' => $postData['id'],
            'name' => $postData['name'],
        ]);
    }
}
