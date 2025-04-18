<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_key',
        'section',
        'title',
        'subtitle',
        'content',
        'extra_data',
        'is_active',
        'order'
    ];

    protected $casts = [
        'extra_data' => 'json',
        'is_active' => 'boolean'
    ];

    /**
     * Get content for a specific page and section
     * 
     * @param string $pageKey
     * @param string|null $section
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getContent($pageKey, $section = null)
    {
        $query = self::where('page_key', $pageKey)
                    ->where('is_active', true)
                    ->orderBy('order');
        
        if ($section) {
            $query->where('section', $section);
        }
        
        return $query->get();
    }

    /**
     * Get first content for a specific page and section
     * 
     * @param string $pageKey
     * @param string $section
     * @return \App\Models\PageContent|null
     */
    public static function getFirstContent($pageKey, $section = 'main')
    {
        return self::where('page_key', $pageKey)
                ->where('section', $section)
                ->where('is_active', true)
                ->orderBy('order')
                ->first();
    }

    /**
     * Get the fillable attributes based on existing columns in the database.
     * 
     * @return array
     */
    public function getFillableColumns()
    {
        $columns = Schema::getColumnListing($this->getTable());
        
        // Remove non-fillable columns
        $nonFillable = ['id', 'created_at', 'updated_at'];
        return array_diff($columns, $nonFillable);
    }
}
