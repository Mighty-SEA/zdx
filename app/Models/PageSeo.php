<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSeo extends Model
{
    use HasFactory;

    protected $fillable = [
        'route',
        'page_id', 
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'is_indexed',
        'is_followed',
        'custom_robots',
        'custom_schema',
    ];

    protected $casts = [
        'is_indexed' => 'boolean',
        'is_followed' => 'boolean',
    ];
} 