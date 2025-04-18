<?php

namespace App\Services;

use App\Models\PageContent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ContentService
{
    /**
     * Mendapatkan konten dari database, atau mengembalikan konten default jika tidak ada
     *
     * @param string $pageIdentifier Identifier untuk halaman (e.g., 'home', 'about', dll)
     * @param string $sectionIdentifier Identifier untuk bagian/elemen (e.g., 'hero-title', 'about-content', dll)
     * @param string $defaultContent Konten default jika tidak ada di database
     * @return string
     */
    public function getContent(string $pageIdentifier, string $sectionIdentifier, string $defaultContent = ''): string
    {
        try {
            $content = PageContent::where('page_identifier', $pageIdentifier)
                ->where('section_identifier', $sectionIdentifier)
                ->first();
                
            if ($content) {
                return $content->content;
            }
        } catch (\Exception $e) {
            Log::error('Error getting content: ' . $e->getMessage(), [
                'page' => $pageIdentifier,
                'section' => $sectionIdentifier
            ]);
        }
        
        return $defaultContent;
    }
    
    /**
     * Membuat directive Blade untuk elemen yang dapat diedit
     *
     * @param string $sectionIdentifier Identifier untuk bagian/elemen
     * @param string $contentType Tipe konten (text, html, dll)
     * @param string $defaultContent Konten default
     * @return string
     */
    public function editable(string $sectionIdentifier, string $contentType, string $content): string
    {
        return '<span data-editable="' . $contentType . '" data-section="' . $sectionIdentifier . '">' . $content . '</span>';
    }
    
    /**
     * Menyimpan konten gambar yang diupload
     *
     * @param string $base64Image Base64 string gambar
     * @param string $pageIdentifier Identifier halaman
     * @param string $sectionIdentifier Identifier elemen
     * @return string URL gambar yang disimpan
     */
    public function saveImageContent(string $base64Image, string $pageIdentifier, string $sectionIdentifier): string
    {
        try {
            // Decode base64 image
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
            
            // Generate unique filename
            $filename = $pageIdentifier . '-' . $sectionIdentifier . '-' . time() . '.png';
            
            // Save image to storage
            $path = 'public/content-images/' . $filename;
            Storage::put($path, $imageData);
            
            // Return public URL
            return Storage::url($path);
        } catch (\Exception $e) {
            Log::error('Error saving image content: ' . $e->getMessage(), [
                'page' => $pageIdentifier,
                'section' => $sectionIdentifier
            ]);
            
            return '';
        }
    }
    
    /**
     * Mencari dan mengganti semua URL gambar dalam konten HTML
     * 
     * @param string $content Konten HTML
     * @param string $pageIdentifier Identifier halaman
     * @param string $sectionIdentifier Identifier elemen
     * @return string Konten dengan URL gambar yang diperbarui
     */
    public function processImagesInContent(string $content, string $pageIdentifier, string $sectionIdentifier): string
    {
        // Cari semua img tag dalam konten
        preg_match_all('/<img[^>]+src="([^"]+)"[^>]*>/i', $content, $matches);
        
        if (empty($matches[1])) {
            return $content;
        }
        
        $updatedContent = $content;
        
        foreach ($matches[1] as $index => $imgUrl) {
            // Periksa apakah ini gambar base64
            if (strpos($imgUrl, 'data:image') === 0) {
                // Simpan gambar dan dapatkan URL baru
                $newUrl = $this->saveImageContent($imgUrl, $pageIdentifier, $sectionIdentifier . '-' . $index);
                
                if (!empty($newUrl)) {
                    // Ganti URL gambar di konten
                    $updatedContent = str_replace($imgUrl, $newUrl, $updatedContent);
                }
            }
        }
        
        return $updatedContent;
    }
} 