<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Services\ContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LiveEditController extends Controller
{
    protected $contentService;
    
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }
    
    /**
     * Mendapatkan data konten halaman untuk mode edit
     */
    public function getPageContent(Request $request)
    {
        $pageIdentifier = $request->input('page');
        $sectionIdentifier = $request->input('section');
        
        $content = PageContent::where('page_identifier', $pageIdentifier)
            ->where('section_identifier', $sectionIdentifier)
            ->first();
            
        if (!$content) {
            return response()->json([
                'success' => false,
                'message' => 'Konten tidak ditemukan'
            ]);
        }
        
        return response()->json([
            'success' => true,
            'content' => $content->content,
            'content_type' => $content->content_type,
            'last_edited_at' => $content->last_edited_at ? $content->last_edited_at->diffForHumans() : null,
            'last_edited_by' => $content->editor ? $content->editor->name : null
        ]);
    }
    
    /**
     * Menyimpan konten halaman yang telah diedit
     */
    public function savePageContent(Request $request)
    {
        try {
            Log::info('Received save content request', $request->all());
            
            $request->validate([
                'page' => 'required|string',
                'section' => 'required|string',
                'content' => 'required',
                'content_type' => 'required|string'
            ]);
            
            $pageIdentifier = $request->input('page');
            $sectionIdentifier = $request->input('section');
            $content = $request->input('content');
            $contentType = $request->input('content_type');
            
            // Jika content adalah array dengan kunci html, ambil nilai htmlnya saja
            if (is_array($content) && isset($content['html'])) {
                $content = $content['html'];
            }
            
            // Proses gambar dalam konten HTML jika tipe konten adalah html atau rich-text
            if (in_array($contentType, ['html', 'rich-text'])) {
                $content = $this->contentService->processImagesInContent($content, $pageIdentifier, $sectionIdentifier);
            }
            
            // Simpan atau update konten
            $pageContent = PageContent::updateOrCreate(
                [
                    'page_identifier' => $pageIdentifier,
                    'section_identifier' => $sectionIdentifier
                ],
                [
                    'content' => $content,
                    'content_type' => $contentType,
                    'last_edited_by' => Auth::id(),
                    'last_edited_at' => now()
                ]
            );
            
            Log::info('Content saved successfully', [
                'page' => $pageIdentifier,
                'section' => $sectionIdentifier,
                'content_id' => $pageContent->id
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Konten berhasil disimpan',
                'content' => $pageContent
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving content: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Mengaktifkan mode editing pada halaman
     */
    public function enableEditMode()
    {
        return response()->json([
            'success' => true,
            'message' => 'Mode edit aktif'
        ]);
    }
    
    /**
     * Menonaktifkan mode editing pada halaman
     */
    public function disableEditMode()
    {
        return response()->json([
            'success' => true,
            'message' => 'Mode edit non-aktif'
        ]);
    }
}
