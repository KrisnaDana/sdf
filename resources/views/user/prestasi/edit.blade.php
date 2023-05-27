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
                            @foreach($tingkats as $tingkat)
                                @if(old('tingkat') == $tingkat || (empty(old('tingkat')) && $prestasi->tingkat == $tingkat))
                                    <option value="{{$tingkat}}" selected>{{$tingkat}}</option>
                                @else
                                    <option value="{{$tingkat}}">{{$tingkat}}</option>
                                @endif
                            @endforeach
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
                    <div class="mb-4">
                        <input class="form-control @error('file_berkas') is-invalid @enderror" type="file" name="file_berkas">
                        @error('file_berkas')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div>
                        <a href="{{route('download-prestasi', ['id' => $prestasi->id])}}" target="_blank" style="width:100%;" type="button" class="model_bt btn btn-success"><i class="fa fa-download text-white"></i>&nbsp;&nbsp;Download berkas prestasi</a>
                    </div>
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection