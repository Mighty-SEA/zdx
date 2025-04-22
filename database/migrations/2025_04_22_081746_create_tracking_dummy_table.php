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
        Schema::create('tracking_dummy', function (Blueprint $table) {
            $table->id();
            $table->string('awb_no')->unique();
            $table->string('reff_no')->nullable();
            $table->string('shipper_name');
            $table->string('receiver_name');
            $table->text('receiver_address');
            $table->string('receiver_phone');
            $table->string('origin_district_code');
            $table->string('destination_district_code');
            $table->string('tlc_origin');
            $table->string('tlc_destination');
            $table->text('special_instruction')->nullable();
            $table->integer('total_colly')->default(1);
            $table->decimal('total_weight_charge', 8, 2)->default(0);
            $table->string('volumetric')->nullable();
            $table->string('service_type_code');
            $table->string('status');
            $table->string('rowstate');
            $table->string('rowstate_name');
            $table->string('transaction_type_code');
            $table->json('timeline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_dummy');
    }
};
