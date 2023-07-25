<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DataMahasiswa;
use App\Models\JalurPendaftaran;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Organisasi;
use App\Models\Prestasi;
use Maatwebsite\Excel\Facades\Excel;


class AdminAkunMahasiswaController extends Controller
{
    public function index(): View
    {
        $mahasiswas = User::with('program_studi:id,nama')->orderBy('nim', 'asc')->get(['id', 'nim', 'nama_lengkap', 'program_studi_id', 'ganti_password']);
        return view('admin.akun-mahasiswa.index', compact('mahasiswas'));
    }

    public function read($id): View
    {
        $mahasiswa = User::find($id);
        return view('admin.akun-mahasiswa.read', compact('mahasiswa'));
    }

    public function viewCreate(): View
    {
        $program_studis = ProgramStudi::all();
        $jalur_pendaftarans = JalurPendaftaran::all();
        return view('admin.akun-mahasiswa.create', compact('program_studis', 'jalur_pendaftarans'));
    }

    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => 'required|integer|digits_between:10,10|unique:App\Models\User,nim',
            'nama_lengkap' => 'required|string|min:1|max:100',
            'jalur_pendaftaran_id' => 'required|exists:App\Models\JalurPendaftaran,id',
            'program_studi_id' => 'required|exists:App\Models\ProgramStudi,id',
            'angkatan' => 'required|date_format:Y'
        ]);
        $mahasiswa = array(
            'nim' => $validated['nim'],
            'password' => bcrypt($validated['nim']),
            'nama_lengkap' => $validated['nama_lengkap'],
            'jalur_pendaftaran_id' => $validated['jalur_pendaftaran_id'],
            'program_studi_id' => $validated['program_studi_id'],
            'angkatan' => $validated['angkatan']
        );
        User::create($mahasiswa);
        return redirect()->route('admin-view-akun-mahasiswa')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan akun mahasiswa."]]);
    }

    public function viewEdit($id): View
    {
        $mahasiswa = User::find($id);
        $program_studis = ProgramStudi::all();
        $jalur_pendaftarans = JalurPendaftaran::all();
        return view('admin.akun-mahasiswa.edit', compact('mahasiswa', 'program_studis', 'jalur_pendaftarans'));
    }

    public function edit(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => 'required|integer|digits_between:10,10|unique:App\Models\User,nim,' . $id,
            'nama_lengkap' => 'required|string|min:1|max:100',
            'jalur_pendaftaran_id' => 'required|exists:App\Models\JalurPendaftaran,id',
            'program_studi_id' => 'required|exists:App\Models\ProgramStudi,id',
            'angkatan' => 'required|date_format:Y'
        ]);
        $mahasiswa = User::find($id);
        $mahasiswa->nim = $validated['nim'];
        $mahasiswa->nama_lengkap = $validated['nama_lengkap'];
        $mahasiswa->jalur_pendaftaran_id = $validated['jalur_pendaftaran_id'];
        $mahasiswa->program_studi_id = $validated['program_studi_id'];
        $mahasiswa->angkatan = $validated['angkatan'];
        $mahasiswa->save();
        return redirect()->route('admin-view-edit-akun-mahasiswa', ['id' => $mahasiswa->id])->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah akun mahasiswa."]]);
    }

    public function resetPassword($id): RedirectResponse
    {
        $mahasiswa = User::find($id);
        $mahasiswa->password = bcrypt($mahasiswa->nim);
        $mahasiswa->ganti_password = "Belum";
        $mahasiswa->save();
        return redirect()->route('admin-view-akun-mahasiswa')->with(["toast" => ["type" => "success", "message" => "Berhasil mereset password akun mahasiswa."]]);
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $mahasiswa = User::find($id);
        if (!empty($request->nim) && $request->nim == $mahasiswa->nim) {
            $organisasis = Organisasi::where('user_id', $id)->get();
            if (!empty($organisasis)) {
                $organisasis->each->delete();
            }
            $prestasis = Prestasi::where('user_id', $id)->get();
            if (!empty($prestasis)) {
                $prestasis->each->delete();
            }
            $mahasiswa->delete();
            return redirect()->route('admin-view-akun-mahasiswa')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus akun mahasiswa."]]);
        } else {
            return redirect()->route('admin-view-akun-mahasiswa')->with(["toast" => ["type" => "danger", "message" => "Gagal menghapus akun mahasiswa."]]);
        }
    }

    public function importexcel(Request $request)
    {
        $data = $request->file('file');

        $namaFile = $data->getClientOriginalName();
        $data->move('DataMahasiswa', $namaFile);

        Excel::import(new DataMahasiswa, \public_path('/DataMahasiswa' . $namaFile));
        return redirect()->route('admin-view-akun-mahasiswa')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan akun mahasiswa."]]);
    }
}
