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
        if(Auth::guard('user')->attempt($validated)){
            $request->session()->regenerate();
            return redirect()->route('view-pengumuman');
        }else{
            return redirect()->back()->with(['error' => 'NIM dan Password tidak sesuai']);
        }
        return redirect()->route('view-login')->with(['error' => 'Sesi pendaftaran belum dibuka.']);
    }
}
