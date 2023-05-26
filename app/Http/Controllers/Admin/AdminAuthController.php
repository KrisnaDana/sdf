<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\ProgramStudi;
use App\Models\JalurPendaftaran;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function viewLogin(): View
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if(Auth::guard('admin')->attempt($validated)){
            $request->session()->regenerate();
            return redirect()->route('admin-view-dashboard');
        }else{
            return redirect()->route('admin-view-login')->with(['error' => 'Username dan Password tidak sesuai.']);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin-view-login');
    }

    public function dashboard(): View
    {
        $program_studis = ProgramStudi::all();
        $mahasiswas = User::get(['id', 'program_studi_id', 'status']);
        $statuses = array(
            'Belum registrasi',
            'Mengajukan registrasi',
            'Perbaikan registrasi',
            'Teregistrasi'
        );
        
        $information = [];
        for($i=0; $i<count($program_studis); $i++){
            for($j=0; $j<count($statuses); $j++){
                $temp = 0;
                foreach($mahasiswas as $mahasiswa){
                    if($mahasiswa->program_studi_id == $program_studis[$i]->id && $mahasiswa->status == $statuses[$j]){
                        $temp++;
                    }
                }
                $information[$i][$j] = $temp;
            }
        }
        $total = [];
        for($i=0; $i<count($program_studis); $i++){
            $temp = 0;
            foreach($mahasiswas as $mahasiswa){
                if($mahasiswa->program_studi_id == $program_studis[$i]->id){
                    $temp++;
                }
            }
            $total[$i] = $temp;
        }
        return view('admin.dashboard', compact('program_studis', 'statuses', 'information', 'total'));
    }

    public function comingSoon(): View
    {
        return view('coming-soon');
    }
}
