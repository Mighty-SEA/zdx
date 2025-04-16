<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_identifier',
        'page_name',
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'og_image',
        'custom_robots',
        'custom_schema',
        'uses_global_settings'
    ];
} 