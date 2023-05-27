<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ProgramStudi;
use App\Models\User;
use App\Models\PeriodePendaftaran;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminProgramStudiController extends Controller
{
    public function index(): View {
        $program_studis = ProgramStudi::orderBy('id', 'asc')->get();
        return view('admin.program-studi.index', compact('program_studis'));
    }

    public function read($id): View {
        $program_studi = ProgramStudi::find($id);
        return view('admin.program-studi.read', compact('program_studi'));
    }

    public function viewCreate(): View {
        return view('admin.program-studi.create');
    }

    public function create(Request $request): RedirectResponse {
        $validated = $request->validate([
            'nama' => 'string|required|min:1|max:50|unique:App\Models\ProgramStudi,nama',
            'link_grup' => 'nullable|string|max:255',
            'qrcode' => 'nullable|file|image|max:10240'
        ]);
        $program_studi = array(
            'nama' => $validated['nama']
        );
        if(!empty($validated['link_grup'])){
            $program_studi['link_grup'] = $validated['link_grup'];
        }
        if(!empty($validated['qrcode'])){
            $qrcode = $request->file('qrcode');
            $filename = Str::slug($validated['nama']) . '.' . $qrcode->getClientOriginalExtension();
            $path = public_path('/img/qrcode');
            $qrcode->move($path, $filename);
            $program_studi['file_qr'] = $filename;
        }
        ProgramStudi::create($program_studi);
        return redirect()->route('admin-view-program-studi')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan program studi."]]);
    }

    public function viewEdit($id): View {
        $program_studi = ProgramStudi::find($id);
        return view('admin.program-studi.edit', compact('program_studi'));
    }

    public function edit(Request $request, $id): RedirectResponse {
        $validated = $request->validate([
            'nama' => 'string|required|min:1|max:50|unique:App\Models\ProgramStudi,nama,'.$id,
            'link_grup' => 'nullable|string|max:255',
            'qrcode' => 'nullable|file|image|max:10240'
        ]);
        $program_studi = ProgramStudi::find($id);
        $program_studi->nama = $validated['nama'];
        if(!empty($validated['link_grup'])){
            $program_studi->link_grup = $validated['link_grup'];
        }else{
            $program_studi->link_grup = null;
        }
        if(!empty($validated['qrcode'])){
            File::delete(public_path('/img/qrcode/').$program_studi->file_qr);
            $qrcode = $request->file('qrcode');
            $filename = Str::slug($validated['nama']) . '.' . $qrcode->getClientOriginalExtension();
            $path = public_path('/img/qrcode');
            $qrcode->move($path, $filename);
            $program_studi->file_qr = $filename;
        }
        $program_studi->save();
        return redirect()->route('admin-view-edit-program-studi', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah program studi."]]);
    }

    public function deleteQrCode($id): RedirectResponse {
        $program_studi = ProgramStudi::find($id);
        if(!empty($program_studi->file_qr)){
            File::delete(public_path('/img/qrcode/').$program_studi->file_qr);
            $program_studi->file_qr = null;
            $program_studi->save();
            return redirect()->route('admin-view-edit-program-studi', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus QR Code."]]);
        }else{
            return redirect()->route('admin-view-edit-program-studi', ['id' => $id])->with(["toast" => ["type" => "danger", "message" => "Tidak ada QR Code untuk dihapus."]]);
        }
    }

    public function delete($id): RedirectResponse {
        $users = User::where('program_studi_id', $id)->get(['id', 'nim', 'program_studi_id']);
        foreach($users as $user) {
            if($user->program_studi_id == $id) {
                return redirect()->route('admin-view-program-studi')->with(["toast" => ["type" => "danger", "message" => "Terdapat mahasiswa pada program studi ini."]]);
            }
        }
        $periode_pendaftarans = PeriodePendaftaran::where('program_studi_id', $id)->get();
        foreach($periode_pendaftarans as $periode_pendaftaran) {
            if($$periode_pendaftaran->program_studi_id == $id) {
                return redirect()->route('admin-view-program-studi')->with(["toast" => ["type" => "danger", "message" => "Program studi ini terdapat pada periode pendaftaran."]]);
            }
        }
        $program_studi = ProgramStudi::find($id);
        if(!empty($program_studi->file_qr)){
            File::delete(public_path('/img/qrcode/').$program_studi->file_qr);
        }
        $program_studi->delete();
        return redirect()->route('admin-view-program-studi')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus program studi."]]);
    }
}
