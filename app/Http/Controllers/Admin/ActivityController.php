<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
            'action' => ['nullable', 'string', 'max:50'],
            'q' => ['nullable', 'string', 'max:100'],
        ]);
        $logs = ActivityLog::query()
            ->with('user')
            ->when(isset($validated['from']), fn (Builder $query) => $query->whereDate('created_at', '>=', $validated['from']))
            ->when(isset($validated['to']), fn (Builder $query) => $query->whereDate('created_at', '<=', $validated['to']))
            ->when(isset($validated['action']), fn (Builder $query) => $query->where('action', $validated['action']))
            ->when(isset($validated['q']), function (Builder $query) use ($validated): void {
                $search = '%'.$validated['q'].'%';
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('description', 'like', $search)
                        ->orWhereHas('user', fn (Builder $userQuery) => $userQuery
                            ->where('name', 'like', $search)
                            ->orWhere('username', 'like', $search));
                });
            })
            ->latest()
            ->paginate(30)
            ->withQueryString();

        return view('admin.activity', [
            'logs' => $logs,
            'actions' => ActivityLog::query()->distinct()->orderBy('action')->pluck('action'),
            'todayCount' => ActivityLog::query()->whereDate('created_at', today())->count(),
            'userCount' => ActivityLog::query()->whereDate('created_at', today())->distinct('user_id')->count('user_id'),
        ]);
    }
}
