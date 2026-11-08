<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table): void {
                $table->id();
                $table->string('name');
                $table->string('username', 50)->unique();
                $table->string('email')->nullable()->unique();
                $table->string('password');
                $table->string('role', 20)->default('siswi');
                $table->boolean('is_active')->default(true);
                $table->boolean('password_change_required')->default(false);
                $table->timestamp('last_login_at')->nullable();
                $table->timestamp('last_activity_at')->nullable()->index();
                $table->rememberToken();
                $table->timestamps();
                $table->index(['role', 'is_active']);
            });
        }

        if (! Schema::hasTable('student_profiles')) {
            Schema::create('student_profiles', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
                $table->string('inisial', 10);
                $table->enum('kelas', ['X', 'XI', 'XII']);
                $table->unsignedTinyInteger('usia');
                $table->string('sekolah', 150);
                $table->timestamps();
                $table->index('kelas');
            });
        }
    }

    public function down(): void
    {
        // These tables may predate Laravel's migration history and contain live accounts.
    }
};
