<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;

class UserAuthController extends Controller
{
    public function viewGantiPassword(): View
    {
        return view('user.ganti-password');
    }

    public function gantiPassword(Request $request): RedirectResponse
    {
        $id = Auth::guard('user')->user()->id;
        $mahasiswa = User::find($id);
        $validated = $request->validate([
            'password' => 'required|alpha_dash:ascii|min:8|max:20|same:konfirmasi_password|not_in:'.$mahasiswa->nim,
            'konfirmasi_password' => 'required|alpha_dash:ascii|min:8|max:20|same:password'
        ]);
        $mahasiswa->password = bcrypt($validated['password']);
        $mahasiswa->ganti_password = "Sudah";
        $mahasiswa->save();
        return redirect()->route('view-pengumuman')->with(["toast" => ["type" => "success", "message" => "Berhasil mengganti password."]]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('view-login');
    }

    public function comingSoon(): View
    {
        return view('coming-soon');
    }
}
