<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'status',
        'image_alt',
        'image_name',
        'author',
        'published_at',
        'category',
        'tags',
        'toc_mode',
        'toc_manual'
    ];
    
    protected $casts = [
        'published_at' => 'datetime',
        'tags' => 'array'
    ];
} 