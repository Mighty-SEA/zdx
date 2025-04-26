<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinifyHtml
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response->headers->get('Content-Type') === 'text/html; charset=UTF-8') {
            $content = $response->getContent();
            
            if (strlen($content) > 0) {
                // Minify HTML
                $minifiedContent = $this->minifyHtml($content);
                $response->setContent($minifiedContent);
            }
        }

        return $response;
    }

    /**
     * Minify HTML content
     */
    private function minifyHtml(string $content): string
    {
        // Remove comments (except IE conditional comments)
        $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
        
        // Remove whitespace
        $content = preg_replace('/\s+/', ' ', $content);
        
        // Remove whitespace between HTML tags
        $content = preg_replace('/>\\s+</', '><', $content);
        
        // Remove whitespace at the beginning and end of the string
        $content = trim($content);
        
        return $content;
    }
} 