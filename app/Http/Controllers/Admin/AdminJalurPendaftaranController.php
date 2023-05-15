<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\JalurPendaftaran;
use App\Models\User;

class AdminJalurPendaftaranController extends Controller
{
    public function index(): View {
        $jalur_pendaftarans = JalurPendaftaran::orderBy('id', 'asc')->get();
        return view('admin.jalur-pendaftaran.index', compact('jalur_pendaftarans'));
    }

    public function viewCreate(): View {
        return view('admin.jalur-pendaftaran.create');
    }

    public function create(Request $request): RedirectResponse {
        $validated = $request->validate([
            'nama' => 'string|required|min:1|max:50|unique:App\Models\JalurPendaftaran,nama' // allow alpha numeric spaces
        ]);
        $jalur_pendaftaran = array(
            'nama' => $validated['nama']
        );
        JalurPendaftaran::create($jalur_pendaftaran);
        return redirect()->route('admin-view-jalur-pendaftaran')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan jalur pendaftaran."]]);
    }

    public function viewEdit($id): View {
        $jalur_pendaftaran = JalurPendaftaran::find($id);
        return view('admin.jalur-pendaftaran.edit', compact('jalur_pendaftaran'));
    }

    public function edit(Request $request, $id): RedirectResponse {
        $validated = $request->validate([
            'nama' => 'string|required|min:1|max:50|unique:App\Models\JalurPendaftaran,nama,'.$id // allow alpha numeric spaces
        ]);
        $jalur_pendaftaran = JalurPendaftaran::find($id);
        $jalur_pendaftaran->nama = $validated['nama'];
        $jalur_pendaftaran->save();
        return redirect()->route('admin-view-jalur-pendaftaran')->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah jalur pendaftaran."]]);
    }

    public function delete($id): RedirectResponse {
        $users = User::where('jalur_pendaftaran_id', $id)->get(['id', 'nim', 'jalur_pendaftaran_id']);
        foreach($users as $user) {
            if($user->jalur_pendaftaran_id == $id) {
                return redirect()->route('admin-view-jalur-pendaftaran')->with(["toast" => ["type" => "danger", "message" => "Terdapat mahasiswa pada jalur pendaftaran ini."]]);
            }
        }
        $jalur_pendaftaran = JalurPendaftaran::find($id);
        $jalur_pendaftaran->delete();
        return redirect()->route('admin-view-jalur-pendaftaran')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus jalur pendaftaran."]]);
    }
}
