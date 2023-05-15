<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\PeriodePendaftaran;
use App\Models\ProgramStudi;
use App\Models\JalurPendaftaran;
use Illuminate\Support\Carbon;

class AdminPeriodePendaftaranController extends Controller
{
    public function index(): View {
        $periode_pendaftarans = PeriodePendaftaran::orderBy('mulai')->get();
        return view('admin.periode-pendaftaran.index', compact('periode_pendaftarans'));
    }

    public function viewCreate(): View {
        $program_studis = ProgramStudi::all();
        $jalur_pendaftarans = JalurPendaftaran::all();
        return view('admin.periode-pendaftaran.create', compact('program_studis', 'jalur_pendaftarans'));
    }

    public function create(Request $request): RedirectResponse{
        $validated = $request->validate([
            'program_studi_id' => 'required|exists:App\Models\ProgramStudi,id',
            'jalur_pendaftaran_id' => 'required|exists:App\Models\JalurPendaftaran,id',
            'mulai' => 'required|date_format:Y-m-d\\TH:i|before:berakhir',
            'berakhir' => 'required|date_format:Y-m-d\\TH:i|after:mulai'
        ]);
        $periode_pendaftaran = array(
            'program_studi_id' => $validated['program_studi_id'],
            'jalur_pendaftaran_id' => $validated['jalur_pendaftaran_id'],
            'mulai' => Carbon::parse($validated['mulai'])->format('Y-m-d H:i:s'),
            'berakhir' => Carbon::parse($validated['berakhir'])->format('Y-m-d H:i:s')
        );
        PeriodePendaftaran::create($periode_pendaftaran);
        return redirect()->route('admin-view-periode-pendaftaran')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan periode pendaftaran."]]);
    }

    public function viewEdit($id): View {
        $periode_pendaftaran = PeriodePendaftaran::find($id);
        $program_studis = ProgramStudi::all();
        $jalur_pendaftarans = JalurPendaftaran::all();
        return view('admin.periode-pendaftaran.edit', compact('periode_pendaftaran', 'program_studis', 'jalur_pendaftarans'));
    }

    public function edit(Request $request, $id): RedirectResponse {
        $validated = $request->validate([
            'program_studi_id' => 'required|exists:App\Models\ProgramStudi,id',
            'jalur_pendaftaran_id' => 'required|exists:App\Models\JalurPendaftaran,id',
            'mulai' => 'required|date_format:Y-m-d\\TH:i|before:berakhir',
            'berakhir' => 'required|date_format:Y-m-d\\TH:i|after:mulai'
        ]);
        $periode_pendaftaran = PeriodePendaftaran::find($id);
        $periode_pendaftaran->program_studi_id = $validated['program_studi_id'];
        $periode_pendaftaran->jalur_pendaftaran_id = $validated['jalur_pendaftaran_id'];
        $periode_pendaftaran->mulai = Carbon::parse($validated['mulai'])->format('Y-m-d H:i:s');
        $periode_pendaftaran->berakhir = Carbon::parse($validated['berakhir'])->format('Y-m-d H:i:s');
        $periode_pendaftaran->save();
        return redirect()->route('admin-view-edit-periode-pendaftaran', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah periode pendaftaran."]]);
    }

    public function delete($id): RedirectResponse {
        $periode_pendaftaran = PeriodePendaftaran::find($id);
        $periode_pendaftaran->delete();
        return redirect()->route('admin-view-periode-pendaftaran')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus periode pendaftaran."]]);
    }
}
