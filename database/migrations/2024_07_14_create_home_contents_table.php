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
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->string('section_key')->unique();
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('content')->nullable();
            $table->string('image_path')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->text('metadata')->nullable()->comment('JSON untuk menyimpan data tambahan seperti statistik atau informasi khusus lainnya');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('use_rich_editor')->default(false)->comment('Menandakan apakah bagian ini menggunakan TinyMCE');
            $table->timestamps();
        });

        // Tambahkan data awal untuk bagian-bagian halaman home
        $this->seedInitialData();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_contents');
    }

    /**
     * Seed initial data for home content sections.
     */
    private function seedInitialData(): void
    {
        $sections = [
            [
                'section_name' => 'Hero Section',
                'section_key' => 'hero',
                'title' => 'Solusi Pengiriman Cepat & Terpercaya',
                'subtitle' => 'Kirim barang Anda ke seluruh Indonesia dengan layanan ekspres yang aman dan tepat waktu',
                'button_text' => 'Lacak Pengiriman',
                'button_url' => '/tracking',
                'order' => 1,
                'is_active' => true,
                'use_rich_editor' => false,
            ],
            [
                'section_name' => 'Statistik',
                'section_key' => 'stats',
                'metadata' => json_encode([
                    [
                        'number' => '10000',
                        'label' => 'Partner',
                        'symbol' => '+'
                    ],
                    [
                        'number' => '100',
                        'label' => 'Project',
                        'symbol' => '+'
                    ],
                    [
                        'number' => '24',
                        'label' => 'Success',
                        'symbol' => '/7'
                    ],
                    [
                        'number' => '99',
                        'label' => 'Country',
                        'symbol' => '%'
                    ]
                ]),
                'order' => 2,
                'is_active' => true,
                'use_rich_editor' => false,
            ],
            [
                'section_name' => 'Layanan',
                'section_key' => 'services',
                'title' => 'Layanan Kami',
                'subtitle' => 'Kami menyediakan berbagai layanan pengiriman yang dirancang untuk memenuhi kebutuhan logistik Anda',
                'order' => 3,
                'is_active' => true,
                'use_rich_editor' => false,
            ],
            [
                'section_name' => 'Keunggulan',
                'section_key' => 'features',
                'title' => 'Mengapa Memilih Kami',
                'subtitle' => 'Keunggulan layanan kami yang memberikan nilai tambah untuk pengiriman Anda',
                'order' => 4,
                'is_active' => true,
                'use_rich_editor' => false,
            ],
            [
                'section_name' => 'Testimonial',
                'section_key' => 'testimonials',
                'title' => 'Apa Kata Mereka',
                'subtitle' => 'Pengalaman pelanggan kami yang telah menggunakan layanan ZDX Express',
                'order' => 5,
                'is_active' => true,
                'use_rich_editor' => false,
            ],
            [
                'section_name' => 'Partner',
                'section_key' => 'partners',
                'title' => 'Dipercaya Oleh',
                'subtitle' => 'Perusahaan dan brand yang telah mempercayakan pengiriman mereka kepada kami',
                'order' => 6,
                'is_active' => true,
                'use_rich_editor' => false,
            ],
            [
                'section_name' => 'CTA',
                'section_key' => 'cta',
                'title' => 'Siap Untuk Menggunakan Layanan Kami?',
                'subtitle' => 'Hubungi kami untuk mendapatkan layanan pengiriman terbaik',
                'button_text' => 'Hubungi Kami',
                'button_url' => '/kontak',
                'order' => 7,
                'is_active' => true,
                'use_rich_editor' => false,
            ],
        ];

        foreach ($sections as $section) {
            DB::table('home_contents')->insert($section);
        }
    }
}; 