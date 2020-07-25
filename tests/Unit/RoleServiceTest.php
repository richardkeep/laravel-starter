<?php

namespace Tests\Unit;

use App\Services\RoleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
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
}
