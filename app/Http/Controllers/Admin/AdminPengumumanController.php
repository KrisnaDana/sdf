<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\PengumumanSdf;
use Illuminate\Support\Facades\File;

class AdminPengumumanController extends Controller
{
    public function index(): View {
        $pengumumans = PengumumanSdf::orderBy('id', 'asc')->get();
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function read($id): View {
        $pengumuman = PengumumanSdf::find($id);
        return view('admin.pengumuman.read', compact('pengumuman'));
    }

    public function viewCreate(): View {
        return view('admin.pengumuman.create');
    }

    public function create(Request $request): RedirectResponse {
        $validated = $request->validate([
            'judul' => 'required|string|min:1|max:50',
            'deskripsi' => 'nullable|string|min:1|max:2000',
            'file_gambar' => 'nullable|file|image|max:10240'
        ]);
        $pengumuman = array(
            'judul' => $validated['judul']
        );
        if(!empty($validated['deskripsi'])){
            $pengumuman['deskripsi'] = $validated['deskripsi'];
        }
        if(!empty($validated['file_gambar'])){
            $file_gambar = $request->file('file_gambar');
            $filename = 'pengumuman-'. time() . "." . $file_gambar->getClientOriginalExtension();
            $path = public_path('/img/pengumuman');
            $file_gambar->move($path, $filename);
            $pengumuman['file_gambar'] = $filename;
        }
        PengumumanSdf::create($pengumuman);
        return redirect()->route('admin-view-pengumuman')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan pengumuman."]]);
    }

    public function viewEdit($id): View {
        $pengumuman = PengumumanSdf::find($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function edit(Request $request, $id): RedirectResponse {
        $validated = $request->validate([
            'judul' => 'required|string|min:1|max:50',
            'deskripsi' => 'nullable|string|min:1|max:2000',
            'file_gambar' => 'nullable|file|image|max:10240'
        ]);
        $pengumuman = PengumumanSdf::find($id);
        $pengumuman->judul = $validated['judul'];
        if(!empty($validated['deskripsi'])){
            $pengumuman->deskripsi = $validated['pengumuman'];
        }else{
            $pengumuman->deskripsi = null;
        }
        if(!empty($validated['file_gambar'])){
            File::delete(public_path('/img/file_gambar/').$pengumuman->file_gambar);
            $file_gambar = $request->file('file_gambar');
            $filename = 'pengumuman-'. time() . "." . $file_gambar->getClientOriginalExtension();
            $path = public_path('/img/pengumuman');
            $file_gambar->move($path, $filename);
            $pengumuman->file_gambar = $filename;
        }
        $pengumuman->save();
        return redirect()->route('admin-view-edit-pengumuman', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah pengumuman."]]);
    }

    public function deleteGambar($id): RedirectResponse {
        $pengumuman = PengumumanSdf::find($id);
        if(!empty($pengumuman->file_gambar)){
            File::delete(public_path('/img/file_gambar/').$pengumuman->file_gambar);
            $pengumuman->file_gambar = null;
            $pengumuman->save();
            return redirect()->route('admin-view-edit-pengumuman', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus gambar pengumuman."]]);
        }
        return redirect()->route('admin-view-edit-pengumuman', ['id' => $id])->with(["toast" => ["type" => "danger", "message" => "Tidak ada gambar pengumuman yang dihapus."]]);
    }

    public function delete($id): RedirectResponse {
        $pengumuman = PengumumanSdf::find($id);
        if(!empty($pengumuman->file_gambar)){
            File::delete(public_path('/img/pengumuman/').$pengumuman->file_gambar);
        }
        $pengumuman->delete();
        return redirect()->route('admin-view-pengumuman')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus pengumuman."]]);
    }
}
