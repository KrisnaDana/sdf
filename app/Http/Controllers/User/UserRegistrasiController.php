<?php

namespace App\Http\Controllers\User;

use App\Models\Note;
use App\Models\User;
use App\Models\Gugus;
use App\Models\Prestasi;
use Illuminate\View\View;
use App\Models\Organisasi;
use App\Models\DetailGugus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class UserRegistrasiController extends Controller
{
    public function viewRegistrasi(): View
    {
        $user =  Auth::guard('user')->user();
        $notes = Note::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        $jenis_kelamins = array(
            'Laki-laki',
            'Perempuan',
        );
        $agamas = array(
            'Hindu',
            'Islam',
            'Budha',
            'Konghucu',
            'Kristen Protestan',
            'Kristen Katolik',
            'Kristen Advent',
            'Penganut Kepercayaan'
        );
        $golongan_darahs = array(
            'A',
            'AB',
            'B',
            'O'
        );
        $konsumsis = array(
            'Non-Vegetarian',
            'Vegetarian'
        );
        return view('user.registrasi', compact('user', 'notes', 'jenis_kelamins', 'agamas', 'golongan_darahs', 'konsumsis'));
    }

    public function registrasi(Request $request): RedirectResponse
    {
        $id = Auth::guard('user')->user()->id;
        $user = User::find($id);
        if (!($user->status == 'Belum registrasi' || $user->status == 'Kesalahan data registrasi')) {
            return redirect()->back();
        }

        if ($user->status == 'Belum registrasi') {
            $validated = $request->validate([
                'pas_foto' => 'required|file|image|mimes:jpg,png,jpeg|max:2048',
                // 'krm' => 'required|file|mimes:pdf|max:2048',
                // 'nama_panggilan' => 'required|string|min:1|max:50',
                // 'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
                // 'agama' => 'required|string|in:Hindu,Islam,Budha,Konghucu,Kristen Protestan,Kristen Katolik,Kristen Advent,Penganut Kepercayaan',
                // 'golongan_darah' => 'required|in:A,AB,B,O',
                // 'tempat_lahir' => 'required|string|min:1|max:300',
                // 'tanggal_lahir' => 'required|date_format:Y-m-d',
                // 'alamat_asal' => 'required|string|min:1|max:300',
                // 'alamat_sekarang' => 'required|string|min:1|max:300',
                // 'no_telepon' => 'required|string|min:3|max:20',
                // 'no_hp' => 'required|string|min:3|max:20',
                // 'id_line' => 'required|string|min:1|max:50',
                // 'email' => 'required|string|email:rfc,dns|max:100',
                // 'asal_sekolah' => 'required|string|min:1|max:100',
                // 'alasan_kuliah' => 'required|string|min:1|max:1000',
                // 'minat_bakat' => 'required|string|min:1|max:200',
                // 'cita_cita' => 'required|string|min:1|max:50',
                // 'idola' => 'required|string|min:1|max:50',
                // 'jumlah_saudara' => 'required|integer|min:0|max:20',
                // 'nama_ayah' => 'required|string|min:1|max:100',
                // 'nama_ibu' => 'required|string|min:1|max:100',
                // 'konsumsi' => 'required|in:Non-Vegetarian,Vegetarian',
                'penyakit_khusus' => 'nullable|string|min:1|max:200'
            ]);

            // $user->nama_panggilan = $validated['nama_panggilan'];
            // $user->jenis_kelamin = $validated['jenis_kelamin'];
            // $user->agama = $validated['agama'];
            // $user->golongan_darah = $validated['golongan_darah'];
            // $user->tempat_lahir = $validated['tempat_lahir'];
            // $user->tanggal_lahir = Carbon::parse($validated['tanggal_lahir'])->format('Y-m-d');
            // $user->alamat_asal = $validated['alamat_asal'];
            // $user->alamat_sekarang = $validated['alamat_sekarang'];
            // $user->no_telepon = $validated['no_telepon'];
            // $user->no_hp = $validated['no_hp'];
            // $user->id_line = $validated['id_line'];
            // $user->email = $validated['email'];
            // $user->asal_sekolah = $validated['asal_sekolah'];
            // $user->alasan_kuliah = $validated['alasan_kuliah'];
            // $user->minat_bakat = $validated['minat_bakat'];
            // $user->cita_cita = $validated['cita_cita'];
            // $user->idola = $validated['idola'];
            // $user->jumlah_saudara = $validated['jumlah_saudara'];
            // $user->nama_ayah = $validated['nama_ayah'];
            // $user->nama_ibu = $validated['nama_ibu'];
            // $user->konsumsi = $validated['konsumsi'];
            if (!empty($validated['penyakit_khusus'])) {
                $user->penyakit_khusus = $validated['penyakit_khusus'];
                $this->addMahasiswaToGugus($user);
            }

            $pas_foto = $request->file('pas_foto');
            $encrypted = "pas_foto-" . $user->nim . "-" . time();
            $filename = Crypt::encryptString($encrypted) . "." . $pas_foto->getClientOriginalExtension();
            $path = public_path('/mahasiswa/pas_foto');
            $pas_foto->move($path, $filename);
            $user->pas_foto = $filename;

            // $krm = $request->file('krm');
            // $encrypted = "krm-" . $user->nim . "-" . time();
            // $filename = Crypt::encryptString($encrypted) . "." . $krm->getClientOriginalExtension();
            // $path = "mahasiswa/krm/";
            // Storage::putFileAs($path, $krm, $filename);
            // $user->krm = $filename;

            // $organisasi = Organisasi::where('user_id', $user->id)->get();
            // if ($request->organisasi == '1' && count($organisasi) == 0) {
            //     return redirect()->back()->with(["toast" => ["type" => "danger", "message" => "Anda belum mengisi data pada menu organisasi."]]);
            // } else {
            //     if (count($organisasi) == 0) {
            //         $user->organisasi = 'Tidak';
            //     } else {
            //         $user->organisasi = 'Ya';
            //     }
            // }

            // $prestasi = Prestasi::where('user_id', $user->id)->get();
            // if ($request->prestasi == '1' && count($prestasi) == 0) {
            //     return redirect()->back()->with(["toast" => ["type" => "danger", "message" => "Anda belum mengisi data pada menu prestasi."]]);
            // } else {
            //     if (count($prestasi) == 0) {
            //         $user->prestasi = 'Tidak';
            //     } else {
            //         $user->prestasi = 'Ya';
            //     }
            // }

            $user->status = 'Teregistrasi';
            $user->save();
            return redirect()->route('view-registrasi')->with(["toast" => ["type" => "success", "message" => "Berhasil mengajukan registrasi."]]);
        } else if ($user->status == 'Kesalahan data registrasi') {
            $validated = $request->validate([
                // 'pas_foto' => 'nullable|file|image|mimes:jpg,png,jpeg|max:2048',
                // 'krm' => 'nullable|file|mimes:pdf|max:2048',
                // 'nama_panggilan' => 'required|string|min:1|max:50',
                // 'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
                // 'agama' => 'required|string|in:Hindu,Islam,Budha,Konghucu,Kristen Protestan,Kristen Katolik,Kristen Advent,Penganut Kepercayaan',
                // 'golongan_darah' => 'required|in:A,AB,B,O',
                // 'tempat_lahir' => 'required|string|min:1|max:300',
                // 'tanggal_lahir' => 'required|date_format:Y-m-d',
                // 'alamat_asal' => 'required|string|min:1|max:300',
                // 'alamat_sekarang' => 'required|string|min:1|max:300',
                // 'no_telepon' => 'required|string|min:3|max:20',
                // 'no_hp' => 'required|string|min:3|max:20',
                // 'id_line' => 'required|string|min:1|max:50',
                // 'email' => 'required|string|email:rfc,dns|max:100',
                // 'asal_sekolah' => 'required|string|min:1|max:100',
                // 'alasan_kuliah' => 'required|string|min:1|max:1000',
                // 'minat_bakat' => 'required|string|min:1|max:200',
                // 'cita_cita' => 'required|string|min:1|max:50',
                // 'idola' => 'required|string|min:1|max:50',
                // 'jumlah_saudara' => 'required|integer|min:0|max:20',
                // 'nama_ayah' => 'required|string|min:1|max:100',
                // 'nama_ibu' => 'required|string|min:1|max:100',
                // 'konsumsi' => 'required|in:Non-Vegetarian,Vegetarian',
                'penyakit_khusus' => 'nullable|string|min:1|max:200'
            ]);

            // $user->nama_panggilan = $validated['nama_panggilan'];
            // $user->jenis_kelamin = $validated['jenis_kelamin'];
            // $user->agama = $validated['agama'];
            // $user->golongan_darah = $validated['golongan_darah'];
            // $user->tempat_lahir = $validated['tempat_lahir'];
            // $user->tanggal_lahir = Carbon::parse($validated['tanggal_lahir'])->format('Y-m-d');
            // $user->alamat_asal = $validated['alamat_asal'];
            // $user->alamat_sekarang = $validated['alamat_sekarang'];
            // $user->no_telepon = $validated['no_telepon'];
            // $user->no_hp = $validated['no_hp'];
            // $user->id_line = $validated['id_line'];
            // $user->email = $validated['email'];
            // $user->asal_sekolah = $validated['asal_sekolah'];
            // $user->alasan_kuliah = $validated['alasan_kuliah'];
            // $user->minat_bakat = $validated['minat_bakat'];
            // $user->cita_cita = $validated['cita_cita'];
            // $user->idola = $validated['idola'];
            // $user->jumlah_saudara = $validated['jumlah_saudara'];
            // $user->nama_ayah = $validated['nama_ayah'];
            // $user->nama_ibu = $validated['nama_ibu'];
            // $user->konsumsi = $validated['konsumsi'];
            if (!empty($validated['penyakit_khusus'])) {
                $user->penyakit_khusus = $validated['penyakit_khusus'];
            } else {
                $user->penyakit_khusus = null;
            }

            if (!empty($validated['pas_foto'])) {
                File::delete(public_path('/mahasiswa/pas_foto/' . $user->pas_foto));
                $pas_foto = $request->file('pas_foto');
                $encrypted = "pas_foto-" . $user->nim . "-" . time();
                $filename = Crypt::encryptString($encrypted) . "." . $pas_foto->getClientOriginalExtension();
                $path = public_path('/mahasiswa/pas_foto');
                $pas_foto->move($path, $filename);
                $user->pas_foto = $filename;
            }

            // if (!empty($validated['krm'])) {
            //     File::delete(storage_path('/app/mahasiswa/krm/' . $user->krm));
            //     $krm = $request->file('krm');
            //     $encrypted = "krm-" . $user->nim . "-" . time();
            //     $filename = Crypt::encryptString($encrypted) . "." . $krm->getClientOriginalExtension();
            //     $path = "mahasiswa/krm/";
            //     Storage::putFileAs($path, $krm, $filename);
            //     $user->krm = $filename;
            // }

            // $organisasi = Organisasi::where('user_id', $user->id)->get();
            // if ($request->organisasi == '1' && count($organisasi) == 0) {
            //     return redirect()->back()->with(["toast" => ["type" => "danger", "message" => "Anda belum mengisi data pada menu organisasi."]]);
            // } else {
            //     if (count($organisasi) == 0) {
            //         $user->organisasi = 'Tidak';
            //     } else {
            //         $user->organisasi = 'Ya';
            //     }
            // }

            // $prestasi = Prestasi::where('user_id', $user->id)->get();
            // if ($request->prestasi == '1' && count($prestasi) == 0) {
            //     return redirect()->back()->with(["toast" => ["type" => "danger", "message" => "Anda belum mengisi data pada menu prestasi."]]);
            // } else {
            //     if (count($prestasi) == 0) {
            //         $user->prestasi = 'Tidak';
            //     } else {
            //         $user->prestasi = 'Ya';
            //     }
            // }

            $user->status = 'Mengajukan perbaikan registrasi';
            $user->save();
            return redirect()->route('view-registrasi')->with(["toast" => ["type" => "success", "message" => "Berhasil mengajukan perbaikan registrasi."]]);
        }

        return redirect()->route('view-registrasi');
    }

    public function downloadKrm(): HttpFoundationResponse
    {
        $user = Auth::guard('user')->user();
        $filename = "krm-" . $user->nim . ".pdf";
        return response()->download(storage_path('/app/mahasiswa/krm/' . $user->krm), $filename);
    }
    public function addMahasiswaToGugus(User $user)
    {
        // Check if the user is already assigned to a gugus in the detail_gugus table
        $existingDetailGugus = DetailGugus::where('user_id', $user->id)->first();

        if (!$existingDetailGugus) {
            // Retrieve the current 'gugus_id' from the last user assigned to a gugus
            $lastUser = User::where('gugus_id', '!=', null)->orderBy('id', 'desc')->first();
            $currentGugus = $lastUser ? $lastUser->gugus_id : 0;
            $gugusId = $this->generateGugusId($currentGugus);

            // Retrieve the 'no_gugus' for the user based on the current 'gugus_id'
            $noGugus = DetailGugus::where('gugus_id', $gugusId)->max('no_gugus_mahasiswa');
            $noGugus = $this->generateNoGugus($noGugus);

            // Save data in the detail_gugus table
            DetailGugus::create([
                'user_id' => $user->id,
                'gugus_id' => $gugusId,
                'no_gugus_mahasiswa' => $noGugus,
            ]);

            // Update the user's 'gugus_id' and 'no_gugus'
            $user->gugus_id = $gugusId;
            $user->no_gugus = 'No Urut ' . $noGugus; // Properly concatenate "No Urut" with $noGugus
            $user->save();
        }
    }

    public function generateGugusId($currentGugus)
    {
        $totalGugus = 10; // Total number of available gugus

        // If the current gugus has reached the total gugus,
        // reset it to 1, otherwise increment it by 1
        if ($currentGugus >= $totalGugus) {
            return 1;
        } else {
            return $currentGugus + 1;
        }
    }

    public function generateNoGugus($noGugusMahasiswaTerakhir)
    {
        $totalGugus = 10; // Total number of available gugus

        // If the no_gugus_mahasiswa_terakhir has reached the total gugus,
        // reset it to 1, otherwise increment it by 1
        if ($noGugusMahasiswaTerakhir >= $totalGugus) {
            return 1;
        } else {
            return $noGugusMahasiswaTerakhir + 1;
        }
    }
}
