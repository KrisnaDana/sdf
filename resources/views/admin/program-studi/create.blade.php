@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Tambah Program Studi</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-program-studi')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                    <a href="{{route('admin-view-create-program-studi')}}"><button type="button" class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{route('admin-create-program-studi')}}" enctype="multipart/form-data">
                @csrf
                <div class="table_section padding_infor_info">
                    <div class="mb-3">
                        <label class="form-label">Nama <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama')}}" spellcheck="disabled" required>
                        @error('nama')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link Grup</label>
                        <input type="text" class="form-control @error('link_grup') is-invalid @enderror" name="link_grup" value="{{old('link_grup')}}" spellcheck="disabled" required>
                        <small>*Link Grup Line untuk Peserta Student Day</small>
                        @error('link_grup')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">QR Code</label>
                        <input class="form-control @error('qrcode') is-invalid @enderror" type="file" name="qrcode">
                        <small>*Pamflet yang Berisi QR Code untuk Grup Line Peserta Student Day</small>
                        <br>
                        <small>*Format File: JPG, PNG, JPEG</small>
                        @error('qrcode')
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