<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use App\Models\Berkas;

class UserBerkasController extends Controller
{
    public function index(): View {
        //
    }

    public function read($id): View {
        //
    }

    public function download($id): HttpFoundationResponse {
        //
    }
}
