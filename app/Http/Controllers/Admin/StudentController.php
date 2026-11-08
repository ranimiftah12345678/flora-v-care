<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\User;
use App\Models\Video;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function show(User $user): View
    {
        $student = $this->studentOrNotFound($user)->load('studentProfile');
        $attempts = $student->testAttempts()
            ->with(['test', 'answers.question'])
            ->whereNotNull('submitted_at')
            ->latest('submitted_at')
            ->get()
            ->groupBy(fn ($attempt): string => $attempt->test->type)
            ->map(fn ($studentAttempts) => $studentAttempts->first());
        $progress = $student->learningProgress->keyBy(fn ($item): string => $item->content_type.':'.$item->content_id);
        $loginHistories = $student->loginHistories()->latest()->limit(10)->get();

        return view('admin.student-detail', [
            'student' => $student,
            'attempts' => $attempts,
            'materials' => Material::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'videos' => Video::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'progress' => $progress,
            'activities' => $student->activityLogs()->latest()->limit(15)->get(),
            'loginHistories' => $loginHistories,
        ]);
    }

    public function index(Request $request): View
    {
        $students = User::query()
            ->where('role', 'siswi')
            ->with('studentProfile')
            ->when($request->filled('q'), function ($query) use ($request): void {
                $search = '%'.$request->string('q')->toString().'%';
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', $search)
                        ->orWhere('username', 'like', $search)
                        ->orWhereHas('studentProfile', fn ($profileQuery) => $profileQuery->where('inisial', 'like', $search));
                });
            })
            ->when($request->input('status') === 'active', fn ($query) => $query->where('is_active', true))
            ->when($request->input('status') === 'inactive', fn ($query) => $query->where('is_active', false))
            ->when($request->filled('kelas'), fn ($query) => $query->whereHas('studentProfile', fn ($profileQuery) => $profileQuery->where('kelas', $request->input('kelas'))))
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.students', [
            'students' => $students,
            'activeCount' => User::query()->where('role', 'siswi')->where('is_active', true)->count(),
            'inactiveCount' => User::query()->where('role', 'siswi')->where('is_active', false)->count(),
        ]);
    }

    public function create(): View
    {
        return view('admin.student-form', ['student' => new User]);
    }

    public function store(Request $request, ActivityLogger $logger): RedirectResponse
    {
        $request->merge([
            'username' => is_string($request->input('username')) ? Str::lower(trim($request->input('username'))) : $request->input('username'),
            'inisial' => is_string($request->input('inisial')) ? Str::upper(trim($request->input('inisial'))) : $request->input('inisial'),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[a-z0-9._-]+$/', Rule::unique('users', 'username')],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')],
            'inisial' => ['required', 'string', 'max:10'],
            'kelas' => ['required', Rule::in(['X', 'XI', 'XII'])],
            'usia' => ['required', 'integer', 'between:10,25'],
            'sekolah' => ['required', 'string', 'max:150'],
            'temporary_password' => ['nullable', 'string', 'min:10'],
        ]);

        $temporaryPassword = $request->filled('temporary_password')
            ? (string) $request->input('temporary_password')
            : Str::password(10);

        $student = DB::transaction(function () use ($validated, $temporaryPassword): User {
            $student = new User;
            $student->name = $validated['name'];
            $student->username = $validated['username'];
            $student->email = null;
            $student->password = Hash::make($temporaryPassword);
            $student->role = 'siswi';
            $student->is_active = true;
            $student->password_change_required = true;
            $student->save();
            $student->studentProfile()->create([
                'inisial' => $validated['inisial'],
                'kelas' => $validated['kelas'],
                'usia' => $validated['usia'],
                'sekolah' => $validated['sekolah'],
            ]);

            return $student;
        });

        $logger->log('buat_siswi', $student->load('studentProfile'), 'Akun siswi dibuat');

        return redirect()->route('admin.students.edit', $student)
            ->with('temporary_password', $temporaryPassword)
            ->with('status', 'Akun siswi berhasil dibuat. Sampaikan sandi sementara ini secara aman.');
    }

    public function edit(User $user): View
    {
        $student = $this->studentOrNotFound($user);

        return view('admin.student-form', ['student' => $student->load('studentProfile')]);
    }

    public function update(Request $request, User $user, ActivityLogger $logger): RedirectResponse
    {
        $student = $this->studentOrNotFound($user);
        $request->merge([
            'username' => is_string($request->input('username')) ? Str::lower(trim($request->input('username'))) : $request->input('username'),
            'inisial' => is_string($request->input('inisial')) ? Str::upper(trim($request->input('inisial'))) : $request->input('inisial'),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[a-z0-9._-]+$/', Rule::unique('users', 'username')->ignore($student->id)],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($student->id)],
            'inisial' => ['required', 'string', 'max:10'],
            'kelas' => ['required', Rule::in(['X', 'XI', 'XII'])],
            'usia' => ['required', 'integer', 'between:10,25'],
            'sekolah' => ['required', 'string', 'max:150'],
        ]);

        DB::transaction(function () use ($student, $validated): void {
            $student->fill([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'email' => $validated['email'] ?? null,
            ])->save();
            $student->studentProfile()->updateOrCreate([], [
                'inisial' => $validated['inisial'],
                'kelas' => $validated['kelas'],
                'usia' => $validated['usia'],
                'sekolah' => $validated['sekolah'],
            ]);
        });

        $logger->log('ubah_siswi', $student, 'Data siswi diperbarui');

        return redirect()->route('admin.students.edit', $student)->with('status', 'Data siswi berhasil diperbarui.');
    }

    public function updateStatus(Request $request, User $user, ActivityLogger $logger): RedirectResponse
    {
        $student = $this->studentOrNotFound($user);
        $validated = $request->validate([
            'is_active' => ['required', 'boolean'],
        ]);

        $student->is_active = (bool) $validated['is_active'];
        $student->save();

        if (! $student->is_active) {
            $this->deleteStudentSessions($student);
        }

        $logger->log('ubah_status_siswi', $student, $student->is_active ? 'Akun diaktifkan' : 'Akun dinonaktifkan');

        return back()->with('status', $student->is_active ? 'Akun siswi diaktifkan.' : 'Akun siswi dinonaktifkan.');
    }

    public function resetPassword(User $user, ActivityLogger $logger): RedirectResponse
    {
        $student = $this->studentOrNotFound($user);
        $temporaryPassword = Str::password(16);

        $student->forceFill([
            'password' => Hash::make($temporaryPassword),
            'password_change_required' => true,
        ])->save();
        $this->deleteStudentSessions($student);
        $logger->log('reset_sandi_siswi', $student, 'Sandi sementara dibuat');

        return back()->with('temporary_password', $temporaryPassword)
            ->with('status', 'Sandi sementara hanya ditampilkan pada halaman ini.');
    }

    private function studentOrNotFound(User $user): User
    {
        abort_unless($user->role === 'siswi', 404);

        return $user;
    }

    private function deleteStudentSessions(User $student): void
    {
        if (Schema::hasTable('sessions')) {
            DB::table('sessions')->where('user_id', $student->id)->delete();
        }
    }
}
