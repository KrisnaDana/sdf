@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Ubah Gugus</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-gugus')}}"><button type="button" class="btn cur-p btn-lg btn-danger"
                            style="float: right;">Kembali</button></a>
                    <a href="{{route('admin-view-edit-gugus', ['id' => $gugus->id])}}"><button type="button"
                            class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i
                                class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{route('admin-edit-gugus', ['id' => $gugus->id])}}"
                enctype="multipart/form-data">
                @csrf
                <div class="table_section padding_infor_info">
                    <div class="mb-3">
                        <label class="form-label">Gugus <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('gugus') is-invalid @enderror" name="gugus"
                            value="{{old('gugus') ? old('gugus') : $gugus->gugus}}" spellcheck="disabled" required>
                        @error('gugus')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link Grup</label>
                        <input type="text" class="form-control @error('link_gugus') is-invalid @enderror"
                            name="link_gugus" value="{{old('link_gugus') ? old('link_gugus') : $gugus->link_gugus}}"
                            spellcheck="disabled" required>
                        <small>*Link Grup Line untuk Peserta Student Day</small>
                        @error('link_gugus')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <label class="form-label">QR Code</label>
                    <div class="mb-3 row">
                        <div class="col-10">
                            <input class="form-control @error('file_qr_gugus') is-invalid @enderror" type="file"
                                name="file_qr_gugus">
                            <small>*Pamflet yang Berisi QR Code untuk Grup Line Peserta Student Day</small>
                            <br>
                            <small>*Format File: JPG, PNG, JPEG</small>
                            @error('file_qr_gugus')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-2">
                            <a href="{{route('admin-delete-gugus-qr-code', ['id' => $gugus->id])}}"><button
                                    type="button" class="btn cur-p btn-lg btn-outline-danger"
                                    style="float: right;">Hapus QR Code</button></a>
                        </div>
                    </div>
                    <div class="mb-3">
                        @if(!empty($gugus->file_qr_gugus))
                        <img class="img-responsive" src="{{url('img/file_qr_gugus/'.$gugus->file_qr_gugus)}}"
                            style="max-height:1000px; max-width:400px;">
                        @endif
                    </div>
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection