<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image_url',
    ];

    /**
     * Get the full image URL.
     *
     * @return string
     */
    public function getImageUrlAttribute($value)
    {
        if (!$value) {
            return asset('asset/default-commodity.jpg');
        }

        if (str_starts_with($value, 'http')) {
            return $value;
        }

        return asset('storage/' . $value);
    }
} 