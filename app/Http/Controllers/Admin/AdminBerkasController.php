<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Berkas;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBerkasController extends Controller
{
    public function index(): View {
        $berkas = Berkas::orderBy('id', 'asc')->get();
        return view('admin.berkas.index', compact('berkas'));
    }

    public function read($id): View {
        $berkas = Berkas::find($id);
        return view('admin.berkas.read', compact('berkas'));
    }

    public function download($id): HttpFoundationResponse {
        $berkas = Berkas::find($id);
        $filename = Str::slug($berkas->nama).".pdf";
        return response()->download(storage_path('/app/berkas/'.$berkas->file_berkas), $filename);
    }

    public function viewCreate(): View {
        return view('admin.berkas.create');
    }

    public function create(Request $request): RedirectResponse {
        $validated = $request->validate([
            'nama' => 'required|string|min:1|max:50',
            'deskripsi' => 'nullable|string|min:1|max:2000',
            'file_berkas' => 'required|file|mimes:pdf,doc,docx|max:10240'
        ]);
        $file_berkas = $request->file('file_berkas');
        $filename = 'berkas-'. time() . "." . $file_berkas->getClientOriginalExtension();
        $path = "berkas/";
        Storage::putFileAs($path, $file_berkas, $filename);
        $berkas = array(
            'nama' => $validated['nama'],
            'file_berkas' => $filename
        );
        if(!empty($validated['deskripsi'])){
            $berkas['deskripsi'] = $validated['deskripsi'];
        }
        Berkas::create($berkas);
        return redirect()->route('admin-view-berkas')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan berkas."]]);
    }

    public function viewEdit($id): View {
        $berkas = Berkas::find($id);
        return view('admin.berkas.edit', compact('berkas'));
    }

    public function edit(Request $request, $id): RedirectResponse {
        $validated = $request->validate([
            'nama' => 'required|string|min:1|max:50',
            'deskripsi' => 'nullable|string|min:1|max:2000',
            'file_berkas' => 'nullable|file|mimes:pdf,doc,docx|max:10240'
        ]);
        $berkas = Berkas::find($id);
        $berkas->nama = $validated['nama'];
        if(!empty($validated['file_berkas'])){
            File::delete(storage_path('/app/berkas/'.$berkas->file_berkas));
            $file_berkas = $request->file('file_berkas');
            $filename = 'berkas-'. time() . "." . $file_berkas->getClientOriginalExtension();
            $path = "berkas/";
            Storage::putFileAs($path, $file_berkas, $filename);
            $berkas->file_berkas = $filename;
        }
        if(!empty($validated['deskripsi'])){
            $berkas->deskripsi = $validated['deskripsi'];
        }else{
            $berkas->deskripsi = null;
        }
        $berkas->save();
        return redirect()->route('admin-view-edit-berkas', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah berkas."]]);
    }

    public function delete($id): RedirectResponse {
        $berkas = Berkas::find($id);
        File::delete(storage_path('/app/berkas/'.$berkas->file_berkas));
        $berkas->delete();
        return redirect()->route('admin-view-berkas')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus berkas."]]);
    }
}
