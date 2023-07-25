@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Berkas</h2>
                </div>
                <div class="col">
                    <a href="{{route('view-berkas')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
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
                    <input type="text" class="form-control" value="{{$berkas->nama}}" spellcheck="disabled" disabled readonly>
                </div>
                <div class="mb-4">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" rows="5" disabled readonly>{{$berkas->deskripsi}}</textarea>
                </div>
                <div class="mb-3">
                    <a href="{{route('download-berkas', ['id' => $berkas->id])}}" target="_blank" style="width:100%;" type="button" class="model_bt btn btn-success"><i class="fa fa-download text-white"></i>&nbsp;&nbsp;Download berkas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection