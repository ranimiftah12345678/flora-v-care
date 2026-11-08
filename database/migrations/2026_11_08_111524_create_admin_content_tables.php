<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('tests')) {
            Schema::create('tests', function (Blueprint $table): void {
                $table->id();
                $table->string('type', 20)->unique();
                $table->string('title');
                $table->text('instructions')->nullable();
                $table->unsignedTinyInteger('max_attempts')->default(1);
                $table->boolean('is_open')->default(false);
                $table->unsignedSmallInteger('attitude_threshold')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('questions')) {
            Schema::create('questions', function (Blueprint $table): void {
                $table->id();
                $table->text('question_text');
                $table->string('aspect', 30)->nullable();
                $table->boolean('is_unfavorable')->default(false);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
                $table->index('sort_order');
            });
        }

        if (! Schema::hasTable('test_questions')) {
            Schema::create('test_questions', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('test_id')->constrained()->cascadeOnDelete();
                $table->foreignId('question_id')->constrained()->cascadeOnDelete();
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
                $table->unique(['test_id', 'question_id']);
            });
        }

        if (! Schema::hasTable('materials')) {
            Schema::create('materials', function (Blueprint $table): void {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('category', 30);
                $table->longText('body');
                $table->string('image')->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_published')->default(false)->index();
                $table->timestamps();
                $table->index(['category', 'sort_order']);
            });
        }

        if (! Schema::hasTable('videos')) {
            Schema::create('videos', function (Blueprint $table): void {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('file_path');
                $table->string('mime_type', 100)->default('video/mp4');
                $table->unsignedBigInteger('file_size')->default(0);
                $table->string('thumbnail')->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->boolean('is_published')->default(false)->index();
                $table->timestamps();
                $table->index('sort_order');
            });
        } elseif (! Schema::hasColumn('videos', 'is_published')) {
            Schema::table('videos', function (Blueprint $table): void {
                $table->boolean('is_published')->default(false)->after('sort_order')->index();
            });
        }

        if (! Schema::hasTable('test_attempts')) {
            Schema::create('test_attempts', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->foreignId('test_id')->constrained()->cascadeOnDelete();
                $table->timestamp('started_at')->nullable();
                $table->timestamp('submitted_at')->nullable();
                $table->unsignedSmallInteger('total_score')->nullable();
                $table->string('kelas', 5)->nullable();
                $table->unsignedTinyInteger('usia')->nullable();
                $table->timestamps();
                $table->index(['user_id', 'test_id']);
            });
        }

        if (! Schema::hasTable('attempt_answers')) {
            Schema::create('attempt_answers', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('attempt_id')->constrained('test_attempts')->cascadeOnDelete();
                $table->foreignId('question_id')->constrained()->cascadeOnDelete();
                $table->unsignedTinyInteger('answer_value');
                $table->unsignedTinyInteger('score');
                $table->timestamps();
                $table->unique(['attempt_id', 'question_id']);
            });
        }

        $now = now();

        DB::table('tests')->insertOrIgnore([
            [
                'type' => 'pretest',
                'title' => 'Pretest',
                'instructions' => 'Jawablah setiap pertanyaan sesuai pemahamanmu.',
                'max_attempts' => 1,
                'is_open' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type' => 'posttest',
                'title' => 'Posttest',
                'instructions' => 'Jawablah setiap pertanyaan sesuai pemahamanmu.',
                'max_attempts' => 1,
                'is_open' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        // Existing content tables may already contain live questions and student responses.
    }
};
