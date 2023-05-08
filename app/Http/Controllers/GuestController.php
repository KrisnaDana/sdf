<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\PeriodePendaftaran;
use App\Models\User;

class GuestController extends Controller
{
    public function index(): View
    {
        return view('guest.index');
    }

    public function viewLogin(): View
    {
        return view('guest.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('nim', '=', $validated['nim'])->orderBy('id', 'DESC')->first();
        $periode_pendaftaran = PeriodePendaftaran::all();
        $now = Carbon::now()->format('Y-m-d H:i:s');
        if(!empty($user)){
            foreach($periode_pendaftaran as $p){
                if($user->program_studi_id == $p->program_studi_id && $user->jalur_pendaftaran_id == $p->jalur_pendaftaran_id && $p->mulai <= $now && $now <= $p->berakhir){
                    if(Auth::guard('user')->attempt($validated)){
                        $request->session()->regenerate();
                        if($user->ganti_password == "Belum"){
                            return redirect()->intended(route('view-ganti-password'));
                        }
                        return redirect()->intended(route('view-biodata'));
                    }else{
                        return redirect()->back()->with(['error' => 'NIM dan Password tidak sesuai']);
                    }
                }
            }
        }
        return redirect()->route('view-login')->with(['error' => 'Sesi pendaftaran belum dibuka.']);
    }
}
