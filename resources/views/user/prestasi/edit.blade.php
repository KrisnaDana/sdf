@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Ubah Prestasi</h2>
                </div>
                <div class="col">
                    <a href="{{route('view-prestasi')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                    <a href="{{route('view-edit-prestasi', ['id' => $prestasi->id])}}"><button type="button" class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{route('edit-prestasi', ['id' => $prestasi->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="table_section padding_infor_info">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama') ? old('nama') : $prestasi->nama}}" spellcheck="disabled" required>
                        @error('nama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tingkat</label>
                        <select class="form-control" name="tingkat">
                            @if(old('tingkat') == "Kabupaten/Kota" || (empty(old('tingkat')) && $prestasi->tingkat == "Kabupaten/Kota"))
                                <option value="Kabupaten/Kota" selected>Kabupaten/Kota</option>
                            @else
                                <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                            @endif
                            @if(old('tingkat') == "Provinsi" || (empty(old('tingkat')) && $prestasi->tingkat == "Provinsi"))
                                <option value="Provinsi" selected>Provinsi</option>
                            @else
                                <option value="Provinsi">Provinsi</option>
                            @endif
                            @if(old('tingkat') == "Nasional" || (empty(old('tingkat')) && $prestasi->tingkat == "Nasional"))
                                <option value="Nasional" selected>Nasional</option>
                            @else
                                <option value="Nasional">Nasional</option>
                            @endif
                            @if(old('tingkat') == "Internasional" || (empty(old('tingkat')) && $prestasi->tingkat == "Internasional"))
                                <option value="Internasional" selected>Internasional</option>
                            @else
                                <option value="Internasional">Internasional</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{old('tahun') ? old('tahun') : $prestasi->tahun}}" spellcheck="disabled" required>
                        @error('tahun')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <label class="form-label">File berkas</label>
                    <div class="mb-3">
                        <input class="form-control @error('file_berkas') is-invalid @enderror" type="file" name="file_berkas">
                        @error('file_berkas')
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