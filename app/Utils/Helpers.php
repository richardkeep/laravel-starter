<?php

use App\Events\AuditEvent;
use App\Services\BreadcrumbService;

if (!function_exists('getBreadCrumbData'))
{
    function getBreadCrumbData(string $pageName) {
        return BreadcrumbService::get($pageName);
    }
}

if (!function_exists('auditEvent'))
{
    function auditEvent(string $message) {
        event(new AuditEvent($message));
        return true;
    }
}
