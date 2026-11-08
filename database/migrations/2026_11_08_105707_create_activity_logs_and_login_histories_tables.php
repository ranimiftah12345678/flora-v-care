<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
                $table->string('action', 50)->index();
                $table->string('subject_type', 100)->nullable();
                $table->unsignedBigInteger('subject_id')->nullable();
                $table->string('description', 500)->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->timestamps();
                $table->index(['user_id', 'created_at'], 'activity_logs_user_created_index');
            });
        }

        if (! Schema::hasTable('login_histories')) {
            Schema::create('login_histories', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->timestamp('logged_in_at')->nullable();
                $table->timestamp('logged_out_at')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->string('user_agent', 500)->nullable();
                $table->timestamps();
                $table->index(['user_id', 'logged_in_at']);
            });
        }
    }

    public function down(): void
    {
        // These audit tables may already exist outside Laravel's migration history.
    }
};
