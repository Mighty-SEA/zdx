<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

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
        'tags'
    ];
    
    protected $casts = [
        'published_at' => 'datetime',
        'tags' => 'array'
    ];
} 