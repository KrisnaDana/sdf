<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Organisasi;

class UserOrganisasiController extends Controller
{
    public function index(): View {
        //
    }

    public function read($id): View {
        //
    }

    public function viewCreate(): View {
        //
    }

    public function create(Request $request): RedirectResponse {
        //
    }

    public function viewEdit($id): View {
        //
    }

    public function edit(Request $request, $id): RedirectResponse {
        //
    }

    public function delete($id): RedirectResponse {
        //
    }
}
