<?php

namespace App\Services;


class BreadcrumbService
{
    public static function get(string $pageName)
    {
        $data = [
            'manage' => [
                "_page_title" => 'Manage',
                'Home' => route('home'),
                'Manage' => null
            ],
            'manage-user-add' => [
                "_page_title" => 'Add user',
                'Home' => route('home'),
                'Manage' => route('manage'),
                'User Add' => null
            ],
            'manage-user-list' => [
                "_page_title" => 'View users',
                'Home' => route('home'),
                'Manage' => route('manage'),
                'Users list' => null
            ],
            'manage-user-view' => [
                "_page_title" => 'View user',
                'Home' => route('home'),
                'Manage' => route('manage'),
                'User details' => null
            ]
        ];

        return isset($data[$pageName]) ? $data[$pageName] : null;
    }
}
