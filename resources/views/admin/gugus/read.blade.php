@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Gugus</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-gugus')}}"><button type="button" class="btn cur-p btn-lg btn-danger"
                            style="float: right;">Kembali</button></a>
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
                    <label class="form-label">Gugus</label>
                    <input type="text" class="form-control" value="{{$gugus->gugus}}" spellcheck="disabled" disabled
                        readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Link Gugus</label>
                    <input type="text" class="form-control" value="{{$gugus->link_gugus}}" spellcheck="disabled"
                        disabled readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">QR Code</label>
                    <div>
                        @if(!empty($gugus->file_qr))
                        <img class="img-responsive" src="{{url('img/qrcode/'.$gugus->file_qr_gugus)}}"
                            style="max-height:1000px; max-width:400px;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection