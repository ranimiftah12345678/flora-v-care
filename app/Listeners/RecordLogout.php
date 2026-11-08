<?php

namespace App\Listeners;

use App\Models\LoginHistory;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;

class RecordLogout
{
    public function __construct(
        private ActivityLogger $logger,
        private Request $request,
    ) {}

    public function handle(Logout $event): void
    {
        if (! $event->user instanceof User) {
            return;
        }

        $loginHistoryId = $this->request->session()->pull('login_history_id');

        if (is_int($loginHistoryId) || (is_string($loginHistoryId) && ctype_digit($loginHistoryId))) {
            LoginHistory::query()
                ->whereKey((int) $loginHistoryId)
                ->where('user_id', $event->user->getKey())
                ->whereNull('logged_out_at')
                ->update(['logged_out_at' => now()]);
        }

        $this->logger->log('logout', $event->user);
    }
}
