<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (method_exists($response, 'header')) {
            // Content Security Policy (CSP)
            $response->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.bunny.net https://fonts.googleapis.com; font-src 'self' data: https://fonts.bunny.net https://fonts.gstatic.com; img-src 'self' data:; frame-ancestors 'self'; form-action 'self';");
            
            // Anti-clickjacking (X-Frame-Options)
            $response->header('X-Frame-Options', 'SAMEORIGIN');
            
            // Anti-MIME-Sniffing (X-Content-Type-Options)
            $response->header('X-Content-Type-Options', 'nosniff');
            
            // Referrer-Policy
            $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');
        }

        // Try to remove X-Powered-By if it's set by PHP
        if (function_exists('header_remove')) {
            header_remove('X-Powered-By');
        }
        
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}
