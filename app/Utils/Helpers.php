<?php

use App\Services\BreadcrumbService;

if (!function_exists('getBreadCrumbData'))
{
    function getBreadCrumbData(string $pageName) {
        return BreadcrumbService::get($pageName);
    }
}
