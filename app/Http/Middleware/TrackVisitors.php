<?php

namespace App\Http\Middleware;

use App\Models\Visit; // Ganti dari App\Models\Setting
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah session pengunjung ini sudah pernah dicatat
        if (!$request->session()->has('has_visited')) {
            // Jika belum, buat record baru di tabel 'visits'.
            // Timestamp akan diisi secara otomatis.
            Visit::create();

            // Tandai session ini agar tidak dihitung lagi pada kunjungan halaman berikutnya
            $request->session()->put('has_visited', true);
        }

        return $next($request);
    }
}
