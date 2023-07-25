@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Ubah Akun Admin</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-akun-admin')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                    <a href="{{route('admin-view-edit-akun-admin', ['id' => $admin->id])}}"><button type="button" class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{route('admin-edit-akun-admin', ['id' => $admin->id])}}">
                @csrf
                <div class="table_section padding_infor_info">
                <div class="mb-3">
                        <label class="form-label">Username <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username') ? old('username') : $admin->username}}" spellcheck="disabled" required>
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama') ? old('nama') : $admin->nama}}" spellcheck="disabled" required>
                        @error('nama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role <span style="color:#FF0000">*</span></label>
                        <select class="form-control" name="role">
                            @foreach($roles as $role)
                                @if(old('role') == $role || (empty(old('role')) && $admin->role == $role))
                                    <option value="{{$role}}" selected>{{$role}}</option>
                                @else
                                    <option value="{{$role}}">{{$role}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" spellcheck="disabled">
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control @error('konfirmasi_password') is-invalid @enderror" name="konfirmasi_password" spellcheck="disabled">
                        @error('konfirmasi_password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection