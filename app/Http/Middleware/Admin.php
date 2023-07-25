<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\PeriodePendaftaran;
use Illuminate\Support\Carbon;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->check()){
            return $next($request);
        }

        if(Auth::guard('user')->check()){
            return redirect()->route('view-pengumuman');
        }

        return redirect()->route('index');
    }
}
