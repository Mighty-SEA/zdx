<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeContent;
use Illuminate\Support\Facades\DB;

class RemovePartnerSection extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus bagian Partner berdasarkan section_key
        HomeContent::where('section_key', 'partners')->delete();
        
        // Perbarui urutan untuk bagian lainnya
        $sections = HomeContent::orderBy('order')->get();
        
        $order = 1;
        foreach ($sections as $section) {
            $section->order = $order;
            $section->save();
            $order++;
        }
        
        $this->command->info('Bagian Partner berhasil dihapus!');
    }
} 