<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\PeriodePendaftaran;
use Illuminate\Support\Carbon;

class Mahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('user')->check()){
            $user = Auth::guard('user')->user();
            $periode_pendaftaran = PeriodePendaftaran::all();
            $now = Carbon::now()->format('Y-m-d H:i:s');
            foreach($periode_pendaftaran as $p){
                if($user->program_studi_id == $p->program_studi_id && $user->jalur_pendaftaran_id == $p->jalur_pendaftaran_id && $p->mulai <= $now && $now <= $p->berakhir){
                    return $next($request);
                }
            }
            Auth::guard('user')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('view-login')->with(['error' => 'Sesi pendaftaran telah berakhir.']);
        }

        if(Auth::guard('admin')->check()){
            return redirect()->route('admin-view-dashboard');
        }

        return redirect()->route('index');
    }
}
