@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Tambah Akun Mahasiswa</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-akun-mahasiswa')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                    <a href="{{route('admin-view-create-akun-mahasiswa')}}"><button type="button" class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{route('admin-create-akun-mahasiswa')}}">
                @csrf
                <div class="table_section padding_infor_info">
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="number" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{old('nim')}}" spellcheck="disabled" required>
                        @error('nim')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{old('nama_lengkap')}}" spellcheck="disabled" required>
                        @error('nama_lengkap')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jalur Pendaftaran</label>
                        @if(count($jalur_pendaftarans) == 0)
                            <input type="text" class="form-control" disabled readonly value="Isi data jalur pendaftaran terlebih dahulu">
                        @else
                            <select class="form-control" name="jalur_pendaftaran_id">
                            @foreach($jalur_pendaftarans as $jalur_pendaftaran)
                                @if(old('jalur_pendaftaran_id') == $jalur_pendaftaran->id)
                                    <option value="{{$jalur_pendaftaran->id}}" selected>{{$jalur_pendaftaran->nama}}</option>
                                @else
                                    <option value="{{$jalur_pendaftaran->id}}">{{$jalur_pendaftaran->nama}}</option>
                                @endif
                            @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Program Studi</label>
                        @if(count($program_studis) == 0)
                            <input type="text" class="form-control" disabled readonly value="Isi data program studi terlebih dahulu">
                        @else
                            <select class="form-control" name="program_studi_id">
                            @foreach($program_studis as $program_studi)
                                @if(old('program_studi_id') == $program_studi->id)
                                    <option value="{{$program_studi->id}}" selected>{{$program_studi->nama}}</option>
                                @else
                                    <option value="{{$program_studi->id}}">{{$program_studi->nama}}</option>
                                @endif
                            @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Angkatan</label>
                        <input type="number" class="form-control @error('angkatan') is-invalid @enderror" name="angkatan" spellcheck="disabled" value="{{ old('angkatan') ? old('angkatan') : date('Y')}}" required>
                        @error('angkatan')
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