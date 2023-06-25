<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\ProgramStudi;
use App\Models\JalurPendaftaran;

class AdminRegistrasiController extends Controller
{
    public function index(Request $request): View {
        if(isset($request->program_studi) && isset($request->jalur_pendaftaran) && isset($request->status)){
            if($request->program_studi != 0 && $request->jalur_pendaftaran != 0 && $request->status != 0){
                $mahasiswas = User::where('program_studi_id', $request->program_studi)
                ->where('jalur_pendaftaran_id', $request->jalur_pendaftaran)
                ->where('status', $request->status)
                ->with(['program_studi:id,nama', 'jalur_pendaftaran:id,nama', 'notes'])
                ->orderBy('nim', 'asc')->get();
            }else if($request->program_studi != 0 && $request->jalur_pendaftaran != 0){
                $mahasiswas = User::where('program_studi_id', $request->program_studi)
                ->where('jalur_pendaftaran_id', $request->jalur_pendaftaran)
                ->with(['program_studi:id,nama', 'jalur_pendaftaran:id,nama', 'notes'])
                ->orderBy('nim', 'asc')->get();
            }else if($request->program_studi != 0 && $request->status != 0){
                $mahasiswas = User::where('program_studi_id', $request->program_studi)
                ->where('status', $request->status)
                ->with(['program_studi:id,nama', 'jalur_pendaftaran:id,nama', 'notes'])
                ->orderBy('nim', 'asc')->get();
            }else if($request->jalur_pendaftaran != 0 && $request->status != 0){
                $mahasiswas = User::where('jalur_pendaftaran_id', $request->jalur_pendaftaran)
                ->where('status', $request->status)
                ->with(['program_studi:id,nama', 'jalur_pendaftaran:id,nama', 'notes'])
                ->orderBy('nim', 'asc')->get();
            }else if($request->program_studi != 0){
                $mahasiswas = User::where('program_studi_id', $request->program_studi)
                ->with(['program_studi:id,nama', 'jalur_pendaftaran:id,nama', 'notes'])
                ->orderBy('nim', 'asc')->get();
            }else if($request->jalur_pendaftaran != 0){
                $mahasiswas = User::where('jalur_pendaftaran_id', $request->jalur_pendaftaran)
                ->with(['program_studi:id,nama', 'jalur_pendaftaran:id,nama', 'notes'])
                ->orderBy('nim', 'asc')->get();
            }else if($request->status != 0){
                $mahasiswas = User::where('status', $request->status)
                ->with(['program_studi:id,nama', 'jalur_pendaftaran:id,nama', 'notes'])
                ->orderBy('nim', 'asc')->get();
            }else{
                $mahasiswas = User::with(['program_studi:id,nama', 'jalur_pendaftaran:id,nama', 'notes'])->orderBy('nim', 'asc')->get();
            }
        }else{
            $mahasiswas = User::with(['program_studi:id,nama', 'jalur_pendaftaran:id,nama', 'notes'])->orderBy('nim', 'asc')->get();
        }
        $program_studis = ProgramStudi::all();
        $jalur_pendaftarans = JalurPendaftaran::all();
        $statuses = array(
            'Belum registrasi',
            'Mengajukan registrasi',
            'Kesalahan data registrasi',
            'Mengajukan perbaikan registrasi',
            'Teregistrasi'
        );
        $filter_program_studi = 0;
        $filter_jalur_pendaftaran = 0;
        $filter_status = 0;
        if(isset($request->program_studi)){
            $filter_program_studi = $request->program_studi;
        }
        if(isset($request->jalur_pendaftaran)){
            $filter_jalur_pendaftaran = $request->jalur_pendaftaran;
        }
        if(isset($request->status)){
            $filter_status = $request->status;
        }
        return view('admin.registrasi.index', compact('mahasiswas', 'program_studis', 'jalur_pendaftarans', 'statuses', 'filter_program_studi', 'filter_jalur_pendaftaran', 'filter_status'));
    }

    public function read($id): View {
        //
    }

    public function downloadPrestasi($id): HttpFoundationResponse {
        //
    }

    public function note(Request $request, $id): RedirectResponse {
        //modal
    } 

    public function konfirmasi($id): RedirectResponse {
        //modal
    }
}
