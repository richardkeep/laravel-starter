<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserManageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_allows_super_admin_to_view_user_list()
    {
        $user = $this->createUserWithRole('super_admin');

        $this->actingAs($user)
            ->get(route('manage.user'))
            ->assertStatus(200);
    }

    /** @test */
    public function it_allows_admin_to_view_user_list()
    {
        $user = $this->createUserWithRole('admin');

        $this->actingAs($user)
            ->get(route('manage.user'))
            ->assertStatus(200);
    }

    /** @test */
    public function it_does_not_allow_other_role_holders_to_view_user_list()
    {
        $user = $this->createUserWithRole('agent');

        $this->actingAs($user)
            ->get(route('manage.user'))
            ->assertStatus(403);
    }
}
