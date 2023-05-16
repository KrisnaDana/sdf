@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Akun Mahasiswa</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-akun-mahasiswa')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <div class="table_section padding_infor_info">
                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="number" class="form-control" value="{{$mahasiswa->nim}}" spellcheck="disabled" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{$mahasiswa->nama_lengkap}}" spellcheck="disabled" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jalur Pendaftaran</label>
                    <input type="text" class="form-control" value="{{$mahasiswa->jalur_pendaftaran->nama}}" spellcheck="disabled" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Program Studi</label>
                    <input type="text" class="form-control" value="{{$mahasiswa->program_studi->nama}}" spellcheck="disabled" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Angkatan</label>
                    <input type="number" class="form-control" spellcheck="disabled" value="{{$mahasiswa->angkatan}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ganti Password</label>
                    <input type="text" class="form-control" spellcheck="disabled" value="{{$mahasiswa->ganti_password}}" readonly disabled>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection