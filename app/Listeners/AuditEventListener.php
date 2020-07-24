<?php

namespace App\Listeners;

use App\Events\AuditEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class AuditEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param AuditEvent $event
     * @return void
     */
    public function handle(AuditEvent $event)
    {
        if (config('app.audit_logs') === true) {
            Log::channel('audit')->info($event->message);
        }
    }
}
