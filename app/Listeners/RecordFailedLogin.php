<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Auth\Events\Failed;

class RecordFailedLogin
{
    public function __construct(private ActivityLogger $logger) {}

    public function handle(Failed $event): void
    {
        $user = $event->user instanceof User ? $event->user : null;

        $this->logger->log('login_gagal', $user);
    }
}
