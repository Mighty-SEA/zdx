<?php

namespace App\Traits;

use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsUserActivity
{
    /**
     * Log aktivitas pengguna.
     *
     * @param  string  $activity
     * @param  array  $properties
     * @return void
     */
    public function logUserActivity(string $activity, array $properties = []): void
    {
        // Pastikan user terotentikasi
        if (!Auth::check()) {
            return;
        }

        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => $activity,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'properties' => $properties
        ]);
    }
} 