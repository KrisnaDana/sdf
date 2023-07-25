<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\PengumumanSdf;

class UserPengumumanController extends Controller
{
    public function viewPengumuman(): View
    {
        $pengumumans = PengumumanSdf::all();
        $aktif = 0;
        foreach($pengumumans as $pengumuman){
            if($pengumuman->status == "Aktif"){
                $aktif = $pengumuman->id;
            }
        }
        return view('user.pengumuman', compact('pengumumans', 'aktif'));
    }
}
