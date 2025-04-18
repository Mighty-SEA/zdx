<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_identifier',
        'section_identifier',
        'content_type',
        'content',
        'last_edited_by',
        'last_edited_at'
    ];

    protected $casts = [
        'last_edited_at' => 'datetime'
    ];

    public function editor()
    {
        return $this->belongsTo(User::class, 'last_edited_by');
    }
} 