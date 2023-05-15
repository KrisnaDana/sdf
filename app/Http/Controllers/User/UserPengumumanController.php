<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserPengumumanController extends Controller
{
    public function viewPengumuman(): View
    {
        return view('user.pengumuman');
    }
}
