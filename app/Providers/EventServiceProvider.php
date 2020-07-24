<?php

namespace App\Providers;

use App\Events\AuditEvent;
use App\Listeners\AuditEventListener;
use App\Listeners\LoginEventHandler;
use App\Listeners\LogoutEventHandler;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AuditEvent::class => [
            AuditEventListener::class
        ],
        Login::class => [
            LoginEventHandler::class
        ],
        Logout::class => [
            LogoutEventHandler::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
