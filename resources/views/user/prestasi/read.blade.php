@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Prestasi</h2>
                </div>
                <div class="col">
                    <a href="{{route('view-prestasi')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
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
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" value="{{$prestasi->nama}}" spellcheck="disabled" disabled readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tingkat</label>
                    <input type="text" class="form-control" value="{{$prestasi->tingkat}}" spellcheck="disabled" disabled readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="text" class="form-control" value="{{$prestasi->tahun}}" spellcheck="disabled" disabled readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">File Berkas</label>
                    <a href="{{route('download-prestasi', ['id' => $prestasi->id])}}" style="width:100%;" type="button" target="_blank" class="model_bt btn btn-success"><i class="fa fa-download text-white"></i>&nbsp;&nbsp;Download berkas prestasi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection