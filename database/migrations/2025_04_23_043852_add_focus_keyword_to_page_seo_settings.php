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
        Schema::table('page_seo_settings', function (Blueprint $table) {
            $table->string('focus_keyword', 255)->nullable()->after('uses_global_settings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_seo_settings', function (Blueprint $table) {
            $table->dropColumn('focus_keyword');
        });
    }
};
