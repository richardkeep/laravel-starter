<?php

namespace App\Services;


use App\User;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function getRoles(User $currentUser)
    {
        return Role::query()
            ->when(!$currentUser->hasRole('super_admin'), function ($query) {
                // only super admin should have the ability
                // to create another super admin
                return $query->where('name', '!=', 'super_admin');
            })
            ->orderBy('name')
            ->get();
    }
}
