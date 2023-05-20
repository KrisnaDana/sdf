@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Organisasi</h2>
                </div>
                <div class="col">
                    <a href="{{route('view-organisasi')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
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
                    <input type="text" class="form-control" value="{{$organisasi->nama}}" spellcheck="disabled" disabled readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" class="form-control" value="{{$organisasi->jabatan}}" spellcheck="disabled" disabled readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="text" class="form-control" value="{{$organisasi->tahun}}" spellcheck="disabled" disabled readonly>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection