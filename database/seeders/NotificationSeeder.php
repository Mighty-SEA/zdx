<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan data lama dibersihkan
        Notification::truncate();
        
        // Cari user admin
        $admin = User::where('role', 'admin')->first();
        
        if ($admin) {
            // Notifikasi 1 - Pengiriman Baru
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'Pengiriman Baru',
                'message' => 'Pesanan #12345 telah dibuat',
                'icon' => 'fas fa-shipping-fast',
                'icon_background' => 'bg-blue-100',
                'icon_color' => 'text-blue-500',
                'created_at' => now()->subMinutes(5)
            ]);
    
            // Notifikasi 2 - Pelanggan Baru
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'Pelanggan Baru',
                'message' => 'John Doe baru saja mendaftar',
                'icon' => 'fas fa-user',
                'icon_background' => 'bg-green-100',
                'icon_color' => 'text-green-500',
                'created_at' => now()->subMinutes(30)
            ]);
    
            // Notifikasi 3 - Pengingat Sistem
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'Pengingat Sistem',
                'message' => 'Perbarui tarif pengiriman',
                'icon' => 'fas fa-exclamation-triangle',
                'icon_background' => 'bg-yellow-100',
                'icon_color' => 'text-yellow-500',
                'link' => '/admin/rates',
                'created_at' => now()->subHours(2)
            ]);
        }
    }
}
