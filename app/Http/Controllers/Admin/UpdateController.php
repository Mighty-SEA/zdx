<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    /**
     * Menjalankan update aplikasi dengan git pull
     */
    public function update(Request $request)
    {
        try {
            // Cek apakah user memiliki hak akses admin
            // Asumsi: Semua user yang bisa login ke admin sudah punya hak akses admin
            // Atau bisa disesuaikan dengan pengecekan ID (misal ID 1 adalah super admin)
            if (Auth::id() != 1) {
                return redirect()->route('admin.settings', ['#update'])->with('update_error', 'Anda tidak memiliki izin untuk melakukan update aplikasi. Hanya user dengan ID 1 yang diperbolehkan.');
            }

            // Eksekusi git pull
            $output = shell_exec('cd ' . base_path() . ' && git pull 2>&1');
            
            // Clear cache
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            
            // Jalankan migrasi normal jika dipilih
            if ($request->has('with_migration') && $request->with_migration) {
                Artisan::call('migrate');
                $migration_output = Artisan::output();
                $output .= "\n\nMigration Output:\n" . $migration_output;
            }
            
            // Jalankan migrate:refresh --seed jika dipilih
            if ($request->has('with_refresh') && $request->with_refresh) {
                Artisan::call('migrate:refresh', ['--seed' => true]);
                $refresh_output = Artisan::output();
                $output .= "\n\nMigrate Refresh Output:\n" . $refresh_output;
            }

            // Log aktivitas update
            Log::info('Aplikasi diupdate oleh: ' . Auth::user()->name . '. Output: ' . $output);

            return redirect()->route('admin.settings', ['#update'])->with('update_success', 'Aplikasi berhasil diupdate!')->with('output', $output);
        } catch (\Exception $e) {
            Log::error('Error saat update aplikasi: ' . $e->getMessage());
            return redirect()->route('admin.settings', ['#update'])->with('update_error', 'Terjadi kesalahan saat update aplikasi: ' . $e->getMessage());
        }
    }
} 