<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'mime_type',
        'file_size',
        'thumbnail',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }
}
