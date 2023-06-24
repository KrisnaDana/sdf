@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Ubah Program Studi</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-program-studi')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                    <a href="{{route('admin-view-edit-program-studi', ['id' => $program_studi->id])}}"><button type="button" class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{route('admin-edit-program-studi', ['id' => $program_studi->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="table_section padding_infor_info">
                    <div class="mb-3">
                        <label class="form-label">Nama <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama') ? old('nama') : $program_studi->nama}}" spellcheck="disabled" required>
                        @error('nama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link Grup</label>
                        <input type="text" class="form-control @error('link_grup') is-invalid @enderror" name="link_grup" value="{{old('link_grup') ? old('link_grup') : $program_studi->link_grup}}" spellcheck="disabled" required>
                        <small>*Link Grup Line untuk Peserta Student Day</small>
                        @error('link_grup')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <label class="form-label">QR Code</label>
                    <div class="mb-3 row">
                        <div class="col-10">
                            <input class="form-control @error('qrcode') is-invalid @enderror" type="file" name="qrcode">
                            <small>*Pamflet yang Berisi QR Code untuk Grup Line Peserta Student Day</small>
                            <br>
                            <small>*Format File: JPG, PNG, JPEG</small>
                            @error('qrcode')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-2">
                            <a href="{{route('admin-delete-program-studi-qr-code', ['id' => $program_studi->id])}}"><button type="button" class="btn cur-p btn-lg btn-outline-danger" style="float: right;">Hapus QR Code</button></a>
                        </div>
                    </div>
                    <div class="mb-3">
                        @if(!empty($program_studi->file_qr))
                        <img class="img-responsive" src="{{url('img/qrcode/'.$program_studi->file_qr)}}" style="max-height:1000px; max-width:400px;">
                        @endif
                    </div>
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection