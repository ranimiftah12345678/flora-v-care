<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ActivityLogger
{
    public function __construct(private Request $request) {}

    public function log(
        string $action,
        ?Authenticatable $user = null,
        ?string $description = null,
        ?Model $subject = null,
    ): ActivityLog {
        $visitorName = $this->request->session()->get('visitor_name');
        $visitorEmail = $this->request->session()->get('visitor_email');

        return ActivityLog::query()->create([
            'user_id' => ($user ?? $this->request->user())?->getAuthIdentifier(),
            'visitor_name' => $visitorName ?: ($user?->name ?? null),
            'visitor_email' => $visitorEmail ?: ($user?->email ?? null),
            'action' => $action,
            'subject_type' => $subject?->getMorphClass(),
            'subject_id' => $subject?->getKey(),
            'description' => $description === null ? null : mb_substr($description, 0, 500),
            'ip_address' => $this->request->ip(),
        ]);
    }
}
