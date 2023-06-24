@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Tambah Akun Admin</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-akun-admin')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                    <a href="{{route('admin-view-create-akun-admin')}}"><button type="button" class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{route('admin-create-akun-admin')}}">
                @csrf
                <div class="table_section padding_infor_info">
                    <div class="mb-3">
                        <label class="form-label">Username <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username')}}" spellcheck="disabled" required>
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama')}}" spellcheck="disabled" required>
                        @error('nama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role <span style="color:#FF0000">*</span></label>
                        <select class="form-control" name="role">
                            @foreach($roles as $role)
                                @if(old('role') == $role)
                                    <option value="{{$role}}" selected>{{$role}}</option>
                                @else
                                    <option value="{{$role}}">{{$role}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password <span style="color:#FF0000">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" spellcheck="disabled" required>
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password <span style="color:#FF0000">*</span></label>
                        <input type="password" class="form-control @error('konfirmasi_password') is-invalid @enderror" name="konfirmasi_password" spellcheck="disabled" required>
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