<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    protected $fillable = ['key', 'value', 'group'];
    
    /**
     * Mendapatkan nilai pengaturan berdasarkan key
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
    
    /**
     * Menyimpan nilai pengaturan
     */
    public static function setValue(string $key, $value, string $group = 'general')
    {
        $setting = self::where('key', $key)->first();
        
        if ($setting) {
            $setting->value = $value;
            $setting->save();
            return $setting;
        }
        
        return self::create([
            'key' => $key,
            'value' => $value,
            'group' => $group
        ]);
    }
    
    /**
     * Mendapatkan semua pengaturan berdasarkan group
     */
    public static function getGroup(string $group = 'general')
    {
        return self::where('group', $group)->get()->pluck('value', 'key')->toArray();
    }
}
