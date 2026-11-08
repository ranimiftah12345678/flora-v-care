<?php

namespace App\Listeners;

use App\Models\LoginHistory;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class RecordLogin
{
    public function __construct(
        private ActivityLogger $logger,
        private Request $request,
    ) {}

    public function handle(Login $event): void
    {
        if (! $event->user instanceof User) {
            return;
        }

        $loginHistory = LoginHistory::query()->create([
            'user_id' => $event->user->getKey(),
            'logged_in_at' => now(),
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->userAgent() === null
                ? null
                : mb_substr($this->request->userAgent(), 0, 500),
        ]);

        $this->request->session()->put('login_history_id', $loginHistory->getKey());

        $this->logger->log('login', $event->user);
    }
}
