<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Dapatkan daftar kolom yang sudah ada di tabel
        $existingColumns = [];
        $columns = DB::select('SHOW COLUMNS FROM settings');
        foreach ($columns as $column) {
            $existingColumns[] = $column->Field;
        }

        Schema::table('settings', function (Blueprint $table) use ($existingColumns) {
            // Logo 1 (Utama)
            if (!in_array('logo_1_path', $existingColumns)) {
                $table->string('logo_1_path')->nullable()->after('value');
            }
            if (!in_array('logo_1_name', $existingColumns)) {
                $table->string('logo_1_name')->nullable()->after('logo_1_path');
            }
            if (!in_array('logo_1_alt', $existingColumns)) {
                $table->string('logo_1_alt')->nullable()->after('logo_1_name');
            }
            if (!in_array('logo_1_updated_at', $existingColumns)) {
                $table->timestamp('logo_1_updated_at')->nullable()->after('logo_1_alt');
            }
            
            // Logo 2
            if (!in_array('logo_2_path', $existingColumns)) {
                $table->string('logo_2_path')->nullable()->after('logo_1_updated_at');
            }
            if (!in_array('logo_2_name', $existingColumns)) {
                $table->string('logo_2_name')->nullable()->after('logo_2_path');
            }
            if (!in_array('logo_2_alt', $existingColumns)) {
                $table->string('logo_2_alt')->nullable()->after('logo_2_name');
            }
            if (!in_array('logo_2_updated_at', $existingColumns)) {
                $table->timestamp('logo_2_updated_at')->nullable()->after('logo_2_alt');
            }
            
            // Logo 3
            if (!in_array('logo_3_path', $existingColumns)) {
                $table->string('logo_3_path')->nullable()->after('logo_2_updated_at');
            }
            if (!in_array('logo_3_name', $existingColumns)) {
                $table->string('logo_3_name')->nullable()->after('logo_3_path');
            }
            if (!in_array('logo_3_alt', $existingColumns)) {
                $table->string('logo_3_alt')->nullable()->after('logo_3_name');
            }
            if (!in_array('logo_3_updated_at', $existingColumns)) {
                $table->timestamp('logo_3_updated_at')->nullable()->after('logo_3_alt');
            }
            
            // Title Logo
            if (!in_array('title_logo_path', $existingColumns)) {
                $table->string('title_logo_path')->nullable()->after('logo_3_updated_at');
            }
            if (!in_array('title_logo_name', $existingColumns)) {
                $table->string('title_logo_name')->nullable()->after('title_logo_path');
            }
            if (!in_array('title_logo_alt', $existingColumns)) {
                $table->string('title_logo_alt')->nullable()->after('title_logo_name');
            }
            if (!in_array('title_logo_updated_at', $existingColumns)) {
                $table->timestamp('title_logo_updated_at')->nullable()->after('title_logo_alt');
            }
            
            // Struktur Organisasi
            if (!in_array('structure_image_path', $existingColumns)) {
                $table->string('structure_image_path')->nullable()->after('title_logo_updated_at');
            }
            if (!in_array('structure_image_name', $existingColumns)) {
                $table->string('structure_image_name')->nullable()->after('structure_image_path');
            }
            if (!in_array('structure_image_alt', $existingColumns)) {
                $table->string('structure_image_alt')->nullable()->after('structure_image_name');
            }
            if (!in_array('structure_image_updated_at', $existingColumns)) {
                $table->timestamp('structure_image_updated_at')->nullable()->after('structure_image_alt');
            }
            
            // Gambar Logistik
            if (!in_array('logistics_image_path', $existingColumns)) {
                $table->string('logistics_image_path')->nullable()->after('structure_image_updated_at');
            }
            if (!in_array('logistics_image_name', $existingColumns)) {
                $table->string('logistics_image_name')->nullable()->after('logistics_image_path');
            }
            if (!in_array('logistics_image_alt', $existingColumns)) {
                $table->string('logistics_image_alt')->nullable()->after('logistics_image_name');
            }
            if (!in_array('logistics_image_updated_at', $existingColumns)) {
                $table->timestamp('logistics_image_updated_at')->nullable()->after('logistics_image_alt');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Drop kolom jika ada
            if (Schema::hasColumn('settings', 'logo_1_path')) {
                $table->dropColumn('logo_1_path');
            }
            if (Schema::hasColumn('settings', 'logo_1_name')) {
                $table->dropColumn('logo_1_name');
            }
            if (Schema::hasColumn('settings', 'logo_1_alt')) {
                $table->dropColumn('logo_1_alt');
            }
            if (Schema::hasColumn('settings', 'logo_1_updated_at')) {
                $table->dropColumn('logo_1_updated_at');
            }
            
            // Kolom-kolom Logo 2
            if (Schema::hasColumn('settings', 'logo_2_path')) {
                $table->dropColumn('logo_2_path');
            }
            if (Schema::hasColumn('settings', 'logo_2_name')) {
                $table->dropColumn('logo_2_name');
            }
            if (Schema::hasColumn('settings', 'logo_2_alt')) {
                $table->dropColumn('logo_2_alt');
            }
            if (Schema::hasColumn('settings', 'logo_2_updated_at')) {
                $table->dropColumn('logo_2_updated_at');
            }
            
            // Kolom-kolom Logo 3
            if (Schema::hasColumn('settings', 'logo_3_path')) {
                $table->dropColumn('logo_3_path');
            }
            if (Schema::hasColumn('settings', 'logo_3_name')) {
                $table->dropColumn('logo_3_name');
            }
            if (Schema::hasColumn('settings', 'logo_3_alt')) {
                $table->dropColumn('logo_3_alt');
            }
            if (Schema::hasColumn('settings', 'logo_3_updated_at')) {
                $table->dropColumn('logo_3_updated_at');
            }
            
            // Kolom-kolom Title Logo
            if (Schema::hasColumn('settings', 'title_logo_path')) {
                $table->dropColumn('title_logo_path');
            }
            if (Schema::hasColumn('settings', 'title_logo_name')) {
                $table->dropColumn('title_logo_name');
            }
            if (Schema::hasColumn('settings', 'title_logo_alt')) {
                $table->dropColumn('title_logo_alt');
            }
            if (Schema::hasColumn('settings', 'title_logo_updated_at')) {
                $table->dropColumn('title_logo_updated_at');
            }
            
            // Kolom-kolom Struktur Organisasi
            if (Schema::hasColumn('settings', 'structure_image_path')) {
                $table->dropColumn('structure_image_path');
            }
            if (Schema::hasColumn('settings', 'structure_image_name')) {
                $table->dropColumn('structure_image_name');
            }
            if (Schema::hasColumn('settings', 'structure_image_alt')) {
                $table->dropColumn('structure_image_alt');
            }
            if (Schema::hasColumn('settings', 'structure_image_updated_at')) {
                $table->dropColumn('structure_image_updated_at');
            }
            
            // Kolom-kolom Logistik
            if (Schema::hasColumn('settings', 'logistics_image_path')) {
                $table->dropColumn('logistics_image_path');
            }
            if (Schema::hasColumn('settings', 'logistics_image_name')) {
                $table->dropColumn('logistics_image_name');
            }
            if (Schema::hasColumn('settings', 'logistics_image_alt')) {
                $table->dropColumn('logistics_image_alt');
            }
            if (Schema::hasColumn('settings', 'logistics_image_updated_at')) {
                $table->dropColumn('logistics_image_updated_at');
            }
        });
    }
};
