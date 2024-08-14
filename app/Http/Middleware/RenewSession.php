<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RenewSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Session verilerini al
        $sessionData = Session::all();

        // Oturumu yeniden başlat
        Session::flush();
        Session::regenerate();

        // Önceki oturum verilerini geri yükle
        Session::put($sessionData);
        return $next($request);
    }
}
