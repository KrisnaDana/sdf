<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gugus;
use App\Http\Requests\StoreGugusRequest;
use App\Http\Requests\UpdateGugusRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ProgramStudi;
use App\Models\User;
use App\Models\PeriodePendaftaran;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class AdminGugusController extends Controller
{
    public function index(): View
    {
        $guguses = Gugus::orderBy('id', 'asc')->get();
        return view('admin.gugus.index', compact('guguses'));
    }

    public function read($id): View
    {
        $gugus = Gugus::find($id);
        return view('admin.gugus.read', compact('gugus'));
    }

    public function viewCreate(): View
    {
        return view('admin.gugus.create');
    }

    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'gugus' => 'string|required|min:1|max:50|unique:App\Models\Gugus,gugus',
            'link_gugus' => 'nullable|string|max:255',
            'file_qr_gugus' => 'nullable|file|image|max:10240'
        ]);
        $gugus = array(
            'gugus' => $validated['gugus']
        );
        if (!empty($validated['link_gugus'])) {
            $gugus['link_gugus'] = $validated['link_gugus'];
        }
        if (!empty($validated['file_qr_gugus'])) {
            $file_qr_gugus = $request->file('file_qr_gugus');
            $filename = Str::slug($validated['gugus']) . '.' . $file_qr_gugus->getClientOriginalExtension();
            $path = public_path('/img/file_qr_gugus');
            $file_qr_gugus->move($path, $filename);
            $gugus['file_qr_gugus'] = $filename;
        }
        Gugus::create($gugus);
        return redirect()->route('admin-view-gugus')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan gugus."]]);
    }

    public function viewEdit($id): View
    {
        $gugus = Gugus::find($id);
        return view('admin.gugus.edit', compact('gugus'));
    }

    public function edit(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'gugus' => 'string|required|min:1|max:50|unique:App\Models\Gugus,gugus,' . $id,
            'link_gugus' => 'nullable|string|max:255',
            'file_qr_gugus' => 'nullable|file|image|max:10240'
        ]);
        $gugus = Gugus::find($id);
        $gugus->gugus = $validated['gugus'];
        if (!empty($validated['link_gugus'])) {
            $gugus->link_gugus = $validated['link_gugus'];
        } else {
            $gugus->link_gugus = null;
        }
        if (!empty($validated['file_qr_gugus'])) {
            File::delete(public_path('/img/file_qr_gugus/') . $gugus->file_qr_gugus);
            $file_qr_gugus = $request->file('file_qr_gugus');
            $filename = Str::slug($validated['gugus']) . '.' . $file_qr_gugus->getClientOriginalExtension();
            $path = public_path('/img/file_qr_gugus');
            $file_qr_gugus->move($path, $filename);
            $gugus->file_qr_gugus = $filename;
        }
        $gugus->save();
        return redirect()->route('admin-view-edit-gugus', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah gugus."]]);
    }

    public function deleteQrCode($id): RedirectResponse
    {
        $gugus = Gugus::find($id);
        if (!empty($gugus->file_qr_gugus)) {
            File::delete(public_path('/img/file_qr_gugus/') . $gugus->file_qr_gugus);
            $gugus->file_qr_gugus = null;
            $gugus->save();
            return redirect()->route('admin-view-edit-gugus', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus Gugus."]]);
        } else {
            return redirect()->route('admin-view-edit-gugus', ['id' => $id])->with(["toast" => ["type" => "danger", "message" => "Tidak ada Gugus untuk dihapus."]]);
        }
    }

    public function delete($id): RedirectResponse
    {
        $users = User::where('gugus_id', $id)->get(['id', 'nim', 'gugus_id']);
        foreach ($users as $user) {
            if ($user->gugus_id == $id) {
                return redirect()->route('admin-view-gugus')->with(["toast" => ["type" => "danger", "message" => "Terdapat mahasiswa pada gugus ini."]]);
            }
        }
        $guguses = User::where('gugus_id', $id)->get();
        foreach ($guguses as $gugus) {
            if ($gugus->gugus_id == $id) {
                return redirect()->route('admin-view-gugus')->with(["toast" => ["type" => "danger", "message" => "Gugus ini terdapat pada periode pendaftaran."]]);
            }
        }
        $gugus = Gugus::find($id);
        if (!empty($gugus->file_qr_gugus)) {
            File::delete(public_path('/img/file_qr_gugus/') . $gugus->file_qr_gugus);
        }
        $gugus->delete();
        return redirect()->route('admin-view-gugus')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus gugus."]]);
    }
}
