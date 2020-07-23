<?php

namespace App\Services;


use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function getRoles()
    {
        $currentUser = Auth::user();

        return Role::query()
            ->when(!$currentUser->hasRole('super_admin'), function ($query) {
                return $query->where('name', '!=', 'super_admin');
            })
            ->orderBy('name')
            ->get();
    }
}
