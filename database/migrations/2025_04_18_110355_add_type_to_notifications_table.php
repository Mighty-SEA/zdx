<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Tambahkan kolom type jika belum ada
            if (!Schema::hasColumn('notifications', 'type')) {
                $table->string('type')->default('info')->after('message'); // info, success, warning, error
            }
            
            // Update default value kolom icon
            $table->string('icon')->default('fas fa-bell')->change();
            
            // Update default value kolom icon_background
            $table->string('icon_background')->default('bg-blue-100')->change();
            
            // Update default value kolom icon_color
            $table->string('icon_color')->default('text-blue-500')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Drop kolom type jika ada
            if (Schema::hasColumn('notifications', 'type')) {
                $table->dropColumn('type');
            }
        });
    }
};
