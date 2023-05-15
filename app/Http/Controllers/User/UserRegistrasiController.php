<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserRegistrasiController extends Controller
{
    public function viewRegistrasi(): View
    {
        return view('user.registrasi');
    }

    public function registrasi(Request $request): RedirectResponse
    {
        return redirect()->route('view-registrasi');
    }
}
