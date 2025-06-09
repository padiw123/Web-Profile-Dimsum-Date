<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceAppUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('local')) {
            // Dapatkan skema dan host dari request (e.g., 'http://127.0.0.1:8000')
            $host = $request->getSchemeAndHttpHost();

            // Atur konfigurasi 'app.url' secara dinamis untuk request ini.
            config(['app.url' => $host]);
        }
        return $next($request);
    }
}
