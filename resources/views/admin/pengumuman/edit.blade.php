@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Ubah Pengumuman</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-pengumuman')}}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                    <a href="{{route('admin-view-edit-pengumuman', ['id' => $pengumuman->id])}}"><button type="button" class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{route('admin-edit-pengumuman', ['id' => $pengumuman->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="table_section padding_infor_info">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{old('judul') ? old('judul') : $pengumuman->judul}}" spellcheck="disabled" required>
                        @error('judul')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="5" spellcheck="disabled" name="deskripsi">{{old('deskripsi') ? old('deskripsi') : $pengumuman->deskripsi}}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <label class="form-label">Gambar</label>
                    <div class="mb-3 row">
                        <div class="col-10">
                            <input class="form-control @error('file_gambar') is-invalid @enderror" type="file" name="file_gambar">
                            @error('file_gambar')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-2">
                            <a href="{{route('admin-delete-pengumuman-gambar', ['id' => $pengumuman->id])}}"><button type="button" class="btn cur-p btn-lg btn-outline-danger" style="float: right;">Hapus Gambar</button></a>
                        </div>
                    </div>
                    <div class="mb-3">
                        @if(!empty($pengumuman->file_gambar))
                        <img class="img-responsive" src="{{url('img/pengumuman/'.$pengumuman->file_gambar)}}" style="max-height:1000px; max-width:400px;">
                        @endif
                    </div>
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection