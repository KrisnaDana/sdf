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

class AdminBerkasController extends Controller
{
    public function index(): View {
        $berkas = Berkas::orderBy('id', 'asc')->get();
        return view('admin.berkas.index', compact('berkas'));
    }

    public function download($id): HttpFoundationResponse {
        $berkas = Berkas::find($id);
        return response()->download(public_path('/berkas/').$berkas->file_berkas);
    }

    public function viewCreate(): View {
        return view('admin.berkas.create');
    }

    public function create(Request $request): RedirectResponse {
        $validated = $request->validate([
            'nama' => 'required|string|min:1|max:50',
            'file_berkas' => 'required|file|mimes:pdf,doc,docx|max:10240'
        ]);
        $file_berkas = $request->file('file_berkas');
        $filename = 'berkas-'. time() . "." . $file_berkas->getClientOriginalExtension();
        $path = public_path('/berkas');
        $file_berkas->move($path, $filename);
        $berkas = array(
            'nama' => $validated['nama'],
            'file_berkas' => $filename
        );
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
            'file_berkas' => 'nullable|file|mimes:pdf,doc,docx|max:10240'
        ]);
        $berkas = Berkas::find($id);
        $berkas->nama = $validated['nama'];
        if(!empty($validated['file_berkas'])){
            File::delete(public_path('/berkas/').$berkas->file_berkas);
            $file_berkas = $request->file('file_berkas');
            $filename = 'berkas-'. time() . "." . $file_berkas->getClientOriginalExtension();
            $path = public_path('/berkas');
            $file_berkas->move($path, $filename);
            $berkas->file_berkas = $filename;
        }
        $berkas->save();
        return redirect()->route('admin-view-edit-berkas', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah berkas."]]);
    }

    public function delete($id): RedirectResponse {
        $berkas = Berkas::find($id);
        File::delete(public_path('/berkas/').$berkas->file_berkas);
        $berkas->delete();
        return redirect()->route('admin-view-berkas')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus berkas."]]);
    }
}
