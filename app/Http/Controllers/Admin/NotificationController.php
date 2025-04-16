<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Mendapatkan daftar notifikasi untuk user yang sedang login
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->take(10)->get();
        $unreadCount = $user->unreadNotifications()->count();
        
        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }
    
    /**
     * Menandai notifikasi sebagai sudah dibaca
     */
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Pastikan notifikasi milik user yang sedang login
        if ($notification->user_id === Auth::id()) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 403);
    }
    
    /**
     * Menandai semua notifikasi sebagai sudah dibaca
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications()->update(['read_at' => now()]);
        
        return response()->json(['success' => true]);
    }
    
    /**
     * Menambahkan notifikasi baru untuk user tertentu
     * Ini bisa dipanggil dari controller lain
     */
    public static function addNotification($userId, $title, $message, $icon = null, $iconBg = null, $iconColor = null, $link = null)
    {
        return Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'icon' => $icon ?: 'fas fa-bell',
            'icon_background' => $iconBg ?: 'bg-blue-100',
            'icon_color' => $iconColor ?: 'text-blue-500',
            'link' => $link,
        ]);
    }
    
    /**
     * Halaman untuk melihat semua notifikasi
     */
    public function all()
    {
        $notifications = Auth::user()->notifications()->latest()->paginate(15);
        return view('admin.notifications', compact('notifications'));
    }
}
