<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserBiodataController extends Controller
{
    public function viewBiodata(): View
    {
        return view('user.biodata');
    }

    public function biodata(Request $request): RedirectResponse
    {
        return redirect()->route('view-biodata');
    }
}
