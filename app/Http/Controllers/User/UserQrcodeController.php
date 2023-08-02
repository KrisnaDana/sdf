<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserQrcodeController extends Controller
{
    public function index(): View
    {
        $user = Auth::guard('user')->user();
        return view('user.qr-code', compact('user'));
    }

    public function link(): RedirectResponse
    {
        $link = Auth::guard('user')->user()->program_studi->link_grup;
        return redirect()->away($link);
    }
    public function linkgugus(): RedirectResponse
    {
        $link = Auth::guard('user')->user()->gugus->link_gugus;
        return redirect()->away($link);
    }
}
