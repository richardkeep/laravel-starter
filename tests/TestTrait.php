<?php

namespace Tests;

use Spatie\Permission\Models\Role;

trait TestTrait
{
    public function getResponseData($response, $asArray = true)
    {
        return json_decode($response->getContent(), $asArray);
    }

    public function assertArraysAreEqual($array1, $array2)
    {
        return $this->assertEqualsCanonicalizing($array1, $array2);
    }

    public function assertValidationError($field, $response)
    {
        $response->assertStatus(422);
        $this->assertArrayHasKey($field, $response->decodeResponseJson('errors'));
    }

    public function createUserWithRole(string $roleName)
    {
        Role::create(['name' => $roleName]);

        $user = factory(\App\User::class)->create();

        $user->assignRole($roleName);

        return $user;
    }
}
