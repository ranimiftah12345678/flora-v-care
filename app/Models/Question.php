<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'question_text',
        'aspect',
        'is_unfavorable',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_unfavorable' => 'boolean',
        ];
    }

    public function tests(): BelongsToMany
    {
        return $this->belongsToMany(Test::class, 'test_questions')
            ->withPivot('sort_order')
            ->withTimestamps();
    }

    public function attemptAnswers(): HasMany
    {
        return $this->hasMany(AttemptAnswer::class);
    }
}
