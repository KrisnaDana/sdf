<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Admin;

class AdminAkunAdminController extends Controller
{
    public function index(): View {
        $admins = Admin::orderBy('role', 'asc')->get();
        return view('admin.akun-admin.index', compact('admins'));
    }

    public function viewCreate(): View {
        $roles = array(
            'Admin',
            'Kesekre'
        );
        return view('admin.akun-admin.create', compact('roles'));
    }

    public function create(Request $request): RedirectResponse{
        $validated = $request->validate([
            'username' => 'required|alpha_dash:ascii|min:1|max:20|unique:App\Models\Admin,username',
            'nama' => 'required|string|min:1|max:30',
            'role' => 'required|string|in:Admin,Kesekre',
            'password' => 'required|alpha_dash:ascii|min:8|max:20|same:konfirmasi_password',
            'konfirmasi_password' => 'required|alpha_dash:ascii|min:8|max:20|same:password'
        ]);
        $admin = array(
            'username' => strtolower($validated['username']),
            'password' => bcrypt($validated['password']),
            'nama' => $validated['nama'],
            'role' => $validated['role'],
        );
        Admin::create($admin);
        return redirect()->route('admin-view-akun-admin')->with(["toast" => ["type" => "success", "message" => "Berhasil menambahkan akun ".strtolower($validated['role'])."."]]);
    }

    public function viewEdit($id): View {
        $admin = Admin::find($id);
        $roles = array(
            'Admin',
            'Kesekre'
        );
        return view('admin.akun-admin.edit', compact('admin', 'roles'));
    }

    public function edit(Request $request, $id): RedirectResponse {
        $validated = $request->validate([
            'username' => 'required|alpha_dash:ascii|min:1|max:20|unique:App\Models\Admin,username,'.$id,
            'nama' => 'required|string|min:1|max:30',
            'role' => 'required|string|in:Admin,Kesekre',
            'password' => 'nullable|required_with:konfirmasi_password|alpha_dash:ascii|min:8|max:20|same:konfirmasi_password',
            'konfirmasi_password' => 'nullable|required_with:password|alpha_dash:ascii|min:8|max:20|same:password'
        ]);
        $admin = Admin::find($id);
        $admin->username = strtolower($validated['username']);
        $admin->nama = $validated['nama'];
        $admin->role = $validated['role'];
        if(!empty($validated['password']) && !empty($validated['konfirmasi_password'])){
            $admin->password = bcrypt($validated['password']);
        }
        $admin->save();
        return redirect()->route('admin-view-edit-akun-admin', ['id' => $id])->with(["toast" => ["type" => "success", "message" => "Berhasil mengubah akun ".strtolower($validated['role'])."."]]);
    }

    public function delete($id): RedirectResponse {
        $admin = Admin::find($id);
        $role = $admin->role;
        $admin->delete();
        return redirect()->route('admin-view-akun-admin')->with(["toast" => ["type" => "success", "message" => "Berhasil menghapus akun ".strtolower($role)."."]]);
    }
}
