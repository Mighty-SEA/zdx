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
            $table->string('contact_phone')->nullable()->after('org_structure_path');
            $table->string('contact_email')->nullable()->after('contact_phone');
            $table->text('contact_address')->nullable()->after('contact_email');
            $table->string('contact_maps_link')->nullable()->after('contact_address');
            $table->string('contact_facebook')->nullable()->after('contact_maps_link');
            $table->string('contact_instagram')->nullable()->after('contact_facebook');
            $table->string('contact_twitter')->nullable()->after('contact_instagram');
            $table->string('contact_youtube')->nullable()->after('contact_twitter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_contents', function (Blueprint $table) {
            $table->dropColumn([
                'contact_phone',
                'contact_email',
                'contact_address',
                'contact_maps_link',
                'contact_facebook',
                'contact_instagram',
                'contact_twitter',
                'contact_youtube'
            ]);
        });
    }
};
