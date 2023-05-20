<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminRegistrasiController extends Controller
{
    public function index(): View {
        //
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
