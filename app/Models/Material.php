<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public const CATEGORIES = [
        'apa_itu' => 'Apa Itu',
        'jenis' => 'Jenis',
        'penyebab' => 'Penyebab',
        'tanda_gejala' => 'Tanda dan Gejala',
        'pencegahan' => 'Pencegahan',
    ];

    protected $fillable = [
        'title',
        'slug',
        'category',
        'body',
        'image',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }
}
