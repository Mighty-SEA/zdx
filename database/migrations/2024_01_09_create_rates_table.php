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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->string('pulau');
            $table->string('provinsi');
            $table->string('kota_kab');
            $table->string('kelurahan_kecamatan');
            $table->decimal('harga_satuan', 10, 2);
            $table->integer('minimal_kg');
            $table->string('estimasi');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
}; 