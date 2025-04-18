<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'title',
        'content',
        'order',
        'is_active',
        'company_name',
        'company_slogan',
        'company_description',
        'org_structure_path',
        'contact_phone',
        'contact_email',
        'contact_address',
        'contact_maps_link',
        'contact_facebook',
        'contact_instagram',
        'contact_twitter',
        'contact_youtube',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
} 