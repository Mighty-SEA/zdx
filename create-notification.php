<?php

require_once __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Http\Controllers\Admin\NotificationController;
use App\Models\User;

// Cari admin pertama
$admin = User::where('role', 'admin')->first();

if ($admin) {
    // Buat notifikasi untuk tarif baru
    NotificationController::addNotification(
        $admin->id,
        'Tarif Baru Ditambahkan',
        'Tarif baru untuk Jakarta Selatan, DKI Jakarta telah ditambahkan dengan harga Rp 18.000',
        'fas fa-dollar-sign',
        'bg-green-100',
        'text-green-500',
        '/admin/rates'
    );
    
    // Buat notifikasi untuk update tarif
    NotificationController::addNotification(
        $admin->id,
        'Tarif Diperbarui',
        'Tarif untuk Bandung, Jawa Barat telah diperbarui menjadi Rp 15.000 (naik 2.000)',
        'fas fa-edit',
        'bg-blue-100',
        'text-blue-500',
        '/admin/rates'
    );
    
    // Buat notifikasi untuk import tarif
    NotificationController::addNotification(
        $admin->id,
        'Import Tarif Berhasil',
        'Import berhasil: 50 data ditambahkan, 10 data diperbarui',
        'fas fa-file-import',
        'bg-green-100',
        'text-green-500',
        '/admin/rates'
    );
    
    echo "Notifikasi tarif berhasil dibuat!";
} else {
    echo "Tidak ada admin yang ditemukan!";
} 