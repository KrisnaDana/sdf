<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use App\Models\Berkas;
use Illuminate\Support\Str;

class UserBerkasController extends Controller
{
    public function index(): View {
        $berkas = Berkas::all();
        return view('user.berkas.index', compact('berkas'));
    }

    public function read($id): View {
        $berkas = Berkas::find($id);
        return view('user.berkas.read', compact('berkas'));
    }

    public function download($id): HttpFoundationResponse {
        $berkas = Berkas::find($id);
        $filename = Str::slug($berkas->nama).".pdf";
        return response()->download(storage_path('/app/berkas/'.$berkas->file_berkas), $filename);
    }

    public function biodata(): HttpFoundationResponse {
        //
    }
}
