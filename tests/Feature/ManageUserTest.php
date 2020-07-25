<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageUserTest extends TestCase
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

    /** @test */
    public function it_shows_add_user_form_to_allowed_user()
    {
        $user = $this->createUserWithRole('super_admin');

        $this->actingAs($user)
            ->get(route('manage.user.add'))
            ->assertStatus(200);
    }

    /** @test */
    public function it_requires_valid_fields_to_create_user()
    {
        $user = $this->createUserWithRole('super_admin');

        $resp = $this->actingAs($user)
            ->json('POST', route('manage.user.save'), []);

        $this->assertValidationError('name', $resp);
        $this->assertValidationError('email', $resp);
        $this->assertValidationError('password', $resp);
    }

    /** @test */
    public function it_allows_super_admin_to_edit_of_a_user()
    {
        $user = $this->createUserWithRole('super_admin');

        factory(User::class, 2)->create();

        $this->actingAs($user)
            ->get(route('manage.user.view', ['user' => 2]))
            ->assertStatus(200);
    }

    /** @test */
    public function it_allows_admin_to_edit_of_a_user()
    {
        $user = $this->createUserWithRole('admin');

        factory(User::class, 2)->create();

        $this->actingAs($user)
            ->get(route('manage.user.view', ['user' => 2]))
            ->assertStatus(200);
    }
}
