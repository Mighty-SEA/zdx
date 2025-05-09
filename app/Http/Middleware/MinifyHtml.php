<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinifyHtml
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->isHtmlResponse($response)) {
            $content = $response->getContent();
            $minified = $this->minify($content);
            $response->setContent($minified);
        }

        return $response;
    }

    /**
     * Cek apakah response berupa HTML.
     */
    protected function isHtmlResponse(Response $response): bool
    {
        $contentType = $response->headers->get('Content-Type');
        
        return $contentType === null || 
               str_contains($contentType, 'text/html');
    }

    /**
     * Minifikasi konten HTML.
     */
    protected function minify(string $content): string
    {
        // Hanya minifikasi jika opsi konfigurasi 'minify_html' aktif
        if (config('app.minify_html', false)) {
            // Simpan script dan form untuk mencegah kerusakan
            $scripts = [];
            $scriptCount = 0;
            $content = preg_replace_callback('/<script\b[^>]*>(.*?)<\/script>/si', function($matches) use (&$scripts, &$scriptCount) {
                $placeholder = "SCRIPTPLACEHOLDER{$scriptCount}";
                $scripts[$placeholder] = $matches[0];
                $scriptCount++;
                return $placeholder;
            }, $content);
            
            $forms = [];
            $formCount = 0;
            $content = preg_replace_callback('/<form\b[^>]*>(.*?)<\/form>/si', function($matches) use (&$forms, &$formCount) {
                $placeholder = "FORMPLACEHOLDER{$formCount}";
                $forms[$placeholder] = $matches[0];
                $formCount++;
                return $placeholder;
            }, $content);
            
            // Simpan textarea
            $textareas = [];
            $textareaCount = 0;
            $content = preg_replace_callback('/<textarea\b[^>]*>(.*?)<\/textarea>/si', function($matches) use (&$textareas, &$textareaCount) {
                $placeholder = "TEXTAREAPLACEHOLDER{$textareaCount}";
                $textareas[$placeholder] = $matches[0];
                $textareaCount++;
                return $placeholder;
            }, $content);
            
            // Hapus komentar HTML (kecuali kondisional IE comments)
            $content = preg_replace('/<!--(?!<!)[^\[>].*?-->/s', '', $content);
            
            // Hapus whitespace berlebih dengan hati-hati
            $content = preg_replace('/\s+/', ' ', $content);
            
            // Hapus spasi di antara tag HTML dengan hati-hati
            $content = preg_replace('/>\s+</', '><', $content);
            
            // Hapus spasi di awal dan akhir tag dengan aman
            $content = preg_replace('/\s+>/', '>', $content);
            $content = preg_replace('/<\s+/', '<', $content);
            
            // Hapus spasi di awal dan akhir konten
            $content = trim($content);
            
            // Kembalikan script dan form ke konten asli
            foreach ($scripts as $placeholder => $script) {
                $content = str_replace($placeholder, $script, $content);
            }
            
            foreach ($forms as $placeholder => $form) {
                $content = str_replace($placeholder, $form, $content);
            }
            
            foreach ($textareas as $placeholder => $textarea) {
                $content = str_replace($placeholder, $textarea, $content);
            }
        }
        
        return $content;
    }
} 