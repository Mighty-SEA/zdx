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
        Schema::table('page_seos', function (Blueprint $table) {
            $table->boolean('uses_global_settings')->default(false)->after('custom_schema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_seos', function (Blueprint $table) {
            $table->dropColumn('uses_global_settings');
        });
    }
};
