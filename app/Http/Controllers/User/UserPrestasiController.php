<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use App\Models\Prestasi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserPrestasiController extends Controller
{
    public function index(): View {
        $user_id = Auth::guard('user')->user()->id;
        $prestasis = Prestasi::where('user_id', $user_id)->orderBy('id', 'asc')->get();
        return view('user.prestasi.index', compact('prestasis'));
    }

    public function read($id): View {
        $user_id = Auth::guard('user')->user()->id;
        $prestasi = Prestasi::find($id);
        if($user_id != $prestasi->user_id) {
            return redirect()->back();
        }
        return view('user.prestasi.read', compact('prestasi'));
    }

    public function download($id): HttpFoundationResponse {
        $prestasi = Prestasi::find($id);
        $filename = Str::slug($prestasi->nama).".pdf";
        return response()->download(storage_path('/app/mahasiswa/prestasi/'.$prestasi->file_berkas), $filename);
    }

    public function viewCreate(): View {
        $tingkats = array(
            'Kabupaten/Kota',
            'Provinsi',
            'Nasional',
            'Internasional'
        );
        return view('user.prestasi.create', compact('tingkats'));
    }

    public function create(Request $request): RedirectResponse {
        $validated = $request->validate([
            'nama' => 'required|string|min:1|max:100',
            'tingkat' => 'required|in:Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'tahun' => 'required|date_format:Y',
            'file_berkas' => 'required|file|mimes:pdf|max:2048'
        ]);
        $file_berkas = $request->file('file_berkas');
        $filename = 'prestasi-'. time() . "." . $file_berkas->getClientOriginalExtension();
        $path = "mahasiswa/prestasi/";
        Storage::putFileAs($path, $file_berkas, $filename);
        $user_id = Auth::guard('user')->user()->id;
        $prestasi = array(
            'user_id' => $user_id,
            'nama' => $validated['nama'],
            'tingkat' => $validated['tingkat'],
            'tahun' => $validated['tahun'],
            'file_berkas' => $filename
        );
        Prestasi::create($prestasi);
        return redirect()->route('view-prestasi')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan prestasi."]]);
    }

    public function viewEdit($id): View {
        $user_id = Auth::guard('user')->user()->id;
        $prestasi = Prestasi::find($id);
        if($user_id != $prestasi->user_id) {
            return redirect()->back();
        }
        $tingkats = array(
            'Kabupaten/Kota',
            'Provinsi',
            'Nasional',
            'Internasional'
        );
        return view('user.prestasi.edit', compact('prestasi', 'tingkats'));
    }

    public function edit(Request $request, $id): RedirectResponse {
        $validated = $request->validate([
            'nama' => 'required|string|min:1|max:100',
            'tingkat' => 'required|in:Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'tahun' => 'required|date_format:Y',
            'file_berkas' => 'nullable|file|mimes:pdf|max:2048'
        ]);
        $user_id = Auth::guard('user')->user()->id;
        $prestasi = Prestasi::find($id);
        if($user_id != $prestasi->user_id) {
            return redirect()->back();
        }
        $prestasi->nama = $validated['nama'];
        $prestasi->tingkat = $validated['tingkat'];
        $prestasi->tahun = $validated['tahun'];
        if(!empty($validated['file_berkas'])){
            File::delete(storage_path('/app/mahasiswa/prestasi/'.$prestasi->file_berkas));
            $file_berkas = $request->file('file_berkas');
            $filename = 'prestasi-'. time() . "." . $file_berkas->getClientOriginalExtension();
            $path = "mahasiswa/prestasi/";
            Storage::putFileAs($path, $file_berkas, $filename);
            $prestasi->file_berkas = $filename;
        }
        $prestasi->save();
        return redirect()->route('view-edit-prestasi', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah prestasi."]]);
    }

    public function delete($id): RedirectResponse {
        $user_id = Auth::guard('user')->user()->id;
        $prestasi = Prestasi::find($id);
        if($user_id != $prestasi->user_id) {
            return redirect()->back();
        }
        File::delete(storage_path('/app/mahasiswa/prestasi/'.$prestasi->file_berkas));
        $prestasi->delete();
        return redirect()->route('view-prestasi')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus prestasi."]]);
    }
}
