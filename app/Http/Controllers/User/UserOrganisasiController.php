<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Organisasi;

class UserOrganisasiController extends Controller
{
    public function index(): View {
        $user = Auth::guard('user')->user();
        $user_id = $user->id;
        $organisasis = Organisasi::where('user_id', $user_id)->orderBy('id', 'asc')->get();
        return view('user.organisasi.index', compact('organisasis', 'user'));
    }

    public function read($id): View {
        $user_id = Auth::guard('user')->user()->id;
        $organisasi = Organisasi::find($id);
        if($user_id != $organisasi->user_id) {
            return redirect()->back();
        }
        return view('user.organisasi.read', compact('organisasi'));
    }

    public function viewCreate(){
        $user = Auth::guard('user')->user();
        if(!($user->status == 'Belum registrasi' || $user->status == 'Kesalahan data registrasi')){
            return redirect()->route('view-organisasi');
        }
        return view('user.organisasi.create');
    }

    public function create(Request $request): RedirectResponse {
        $user = Auth::guard('user')->user();
        if(!($user->status == 'Belum registrasi' || $user->status == 'Kesalahan data registrasi')){
            return redirect()->route('view-organisasi');
        }
        $validated = $request->validate([
            'nama' => 'required|string|min:1|max:100',
            'jabatan' => 'required|string|min:1|max:50',
            'tahun' => 'required|date_format:Y'
        ]);
        $user_id = $user->id;
        $organisasi = array(
            'user_id' => $user_id,
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'tahun' => $validated['tahun']
        );
        Organisasi::create($organisasi);
        return redirect()->route('view-organisasi')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan organisasi."]]);
    }

    public function viewEdit($id){
        $user = Auth::guard('user')->user();
        if(!($user->status == 'Belum registrasi' || $user->status == 'Kesalahan data registrasi')){
            return redirect()->route('view-organisasi');
        }
        $user_id = $user->id;
        $organisasi = Organisasi::find($id);
        if($user_id != $organisasi->user_id) {
            return redirect()->back();
        }
        return view('user.organisasi.edit', compact('organisasi'));
    }

    public function edit(Request $request, $id): RedirectResponse {
        $user = Auth::guard('user')->user();
        if(!($user->status == 'Belum registrasi' || $user->status == 'Kesalahan data registrasi')){
            return redirect()->route('view-organisasi');
        }
        $validated = $request->validate([
            'nama' => 'required|string|min:1|max:100',
            'jabatan' => 'required|string|min:1|max:50',
            'tahun' => 'required|date_format:Y'
        ]);
        $user_id = $user->id;
        $organisasi = Organisasi::find($id);
        if($user_id != $organisasi->user_id) {
            return redirect()->back();
        }
        $organisasi->nama = $validated['nama'];
        $organisasi->jabatan = $validated['jabatan'];
        $organisasi->tahun = $validated['tahun'];
        $organisasi->save();
        return redirect()->route('view-edit-organisasi', ['id' => $organisasi->id])->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah organisasi."]]);
    }

    public function delete($id): RedirectResponse {
        $user = Auth::guard('user')->user();
        if(!($user->status == 'Belum registrasi' || $user->status == 'Kesalahan data registrasi')){
            return redirect()->route('view-organisasi');
        }
        $user_id = $user->id;
        $organisasi = Organisasi::find($id);
        if($user_id != $organisasi->user_id) {
            return redirect()->back();
        }
        $organisasi->delete();
        return redirect()->route('view-organisasi')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus organisasi."]]);
    }
}
