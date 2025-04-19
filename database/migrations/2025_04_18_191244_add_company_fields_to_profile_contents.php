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
        Schema::table('profile_contents', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('content');
            $table->string('company_slogan')->nullable()->after('company_name');
            $table->text('company_description')->nullable()->after('company_slogan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_contents', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'company_slogan', 'company_description']);
        });
    }
};
