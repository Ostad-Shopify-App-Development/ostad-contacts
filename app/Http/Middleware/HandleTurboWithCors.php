<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleTurboWithCors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->hasHeader('X-Turbo-Request-Id')) {
            // Bypass CORS middleware for Turbo prefetch requests
            return $next($request);
        }
        
        // Apply CORS middleware for other requests
        return app(HandleCors::class)->handle($request, $next);
    }
}
