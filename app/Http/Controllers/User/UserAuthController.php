<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserAuthController extends Controller
{
    public function viewGantiPassword(): View
    {
        return view('user.ganti-password');
    }

    public function gantiPassword(): RedirectResponse
    {
        //
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
