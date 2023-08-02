<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use App\Models\Berkas;
use App\Models\Organisasi;
use App\Models\Prestasi;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;

class UserBerkasController extends Controller
{
    public function index()
    {
        $berkas = Berkas::all();
        return view('user.berkas.index', compact('berkas'));
    }

    public function read($id)
    {
        $berkas = Berkas::find($id);
        return view('user.berkas.read', compact('berkas'));
    }

    public function download($id): HttpFoundationResponse
    {
        $berkas = Berkas::find($id);
        $filename = Str::slug($berkas->nama) . ".pdf";
        return response()->download(storage_path('/app/berkas/' . $berkas->file_berkas), $filename);
    }

    public function biodata()
    {
        $user = Auth::guard('user')->user();
        $user = User::find($user->id);
        $organisasis = Organisasi::where('user_id', $user->id)->get();
        $prestasis = Prestasi::where('user_id', $user->id)->get();
        $program_studi = ProgramStudi::find($user->program_studi_id)->nama;
        $filename = "FORM VERIFIKASI " . $user->nim . ".pdf";
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('chroot', realpath(base_path()));
        $dompdf->setOptions($options);
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($contxt);
        $view = View::make('user.berkas.verifikasi', compact('user', 'organisasis', 'prestasis', 'program_studi'));
        $html = $view->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfContent = $dompdf->output();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="FILE VERIFIKASI ' . $user->nim . '.pdf"',
        ];
        $response = new Response($pdfContent, 200, $headers);
        return $response;
    }
}
