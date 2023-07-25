@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="py-2">
                <h2>QR Code</h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <div class="table_section padding_infor_info">
                @if($user->koordinator == "Ya")
                <div class="mb-4">
                    <div class="alert alert-primary" role="alert">
                        <i class="fa fa-info-circle"></i>&nbsp;&nbsp;Selamat anda dipilih menjadi Koordinator Angkatan Program Studi!
                    </div>
                </div>
                @endif
                <div class="text-center mb-4">
                    <img src="{{url('/img/qrcode/', $user->program_studi->file_qr)}}" style="width:100%;">
                </div>
                <div class="mb-3">
                    <a href="{{route('link-qrcode')}}" style="width:100%;" type="button" target="_blank" class="model_bt btn btn-success"><i class="fa fa-sign-in text-white"></i>&nbsp;&nbsp;Bergabung ke Grup</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection