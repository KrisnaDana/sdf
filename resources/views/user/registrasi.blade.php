@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Registrasi</h2>
                </div>
                <div class="col">
                    <a href="{{route('view-registrasi')}}"><button type="button"
                            class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i
                                class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30 padding_40">
            <div class="padding_infor_info">
                @if($user->status == 'Belum registrasi')
                <div class="alert alert-warning mb-0" role="alert" style="width:100%;">
                    <i class="fa fa-bell text-warning"></i> Belum Registrasi STUDENT DAY - PKKMB {{date('Y')}}.
                </div>
                @elseif($user->status == 'Mengajukan registrasi')
                <div class="alert alert-primary mb-0" role="alert" style="width:100%;">
                    <i class="fa fa-circle-o text-primary"></i> Mengajukan Registrasi STUDENT DAY - PKKMB {{date('Y')}}.
                </div>
                @elseif($user->status == 'Kesalahan data registrasi')
                <div class="alert alert-danger mb-0" role="alert" style="width:100%;">
                    <i class="fa fa-exclamation-circle text-danger"></i> Terdapat Kesalahan pada Data Registrasi.
                </div>
                @foreach($notes as $note)
                <div class="alert alert-danger mb-0 mt-3" role="alert" style="width:100%;">
                    Catatan dari Admin: <strong>{{$note->note}}</strong>
                    <div>Dikirim Pada: {{date_format($note->created_at,"H:i:s d/m/Y")}}</div>
                </div>
                @break
                @endforeach
                @elseif($user->status == 'Mengajukan perbaikan registrasi')
                <div class="alert alert-primary mb-0" role="alert" style="width:100%;">
                    <i class="fa fa-circle-o text-primary"></i> Mengajukan Perbaikan Registrasi STUDENT DAY - PKKMB
                    {{date('Y')}}.
                </div>
                @elseif($user->status == 'Teregistrasi')
                <div class="alert alert-success mb-0" role="alert" style="width:100%;">
                    <i class="fa fa-check text-success"></i> Registrasi STUDENT DAY - PKKMB {{date('Y')}} Berhasil.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($user->status == 'Belum registrasi' || $user->status == 'Kesalahan data registrasi')
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{route('registrasi')}}" enctype="multipart/form-data">
                @csrf
                <div class="table_section padding_infor_info">
                    <div class="mb-3 d-flex">
                        <div class="">
                            @if(!empty($user->pas_foto))
                            <img src="{{url('mahasiswa/pas_foto/'. $user->pas_foto)}}"
                                style="width:150px; height:200px; display:block;" id="pas_foto">
                            @else
                            <img src="{{url('img/foto3x4.jpg')}}" style="width:150px; height:200px; display:block;"
                                id="pas_foto">
                            @endif
                        </div>
                        <div class="w-100 mt-2 ml-2">
                            @if($user->status == 'Belum registrasi')
                            <label class="form-label">Pas Foto <span style="color:#FF0000">*</span></label>
                            <input class="form-control @error('pas_foto') is-invalid @enderror" type="file"
                                name="pas_foto" required onchange="readURL(this);">
                            @else
                            <label class="form-label">Pas Foto</label>
                            <input class="form-control @error('pas_foto') is-invalid @enderror" type="file"
                                name="pas_foto" onchange="readURL(this);">
                            @endif
                            <small>*Upload Pas Foto dengan Ketentuan Bebas Rapi</small>
                            <br>
                            <small>*Ukuran File Maksimal 2 MB</small>
                            <br>
                            <small>*Format File: JPG, PNG, JPEG</small>
                            @error('pas_foto')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" value="{{$user->nim}}" spellcheck="disabled" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{$user->nama_lengkap}}" spellcheck="disabled"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jalur Pendaftaran</label>
                        <input type="text" class="form-control" value="{{$user->jalur_pendaftaran->nama}}"
                            spellcheck="disabled" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Program Studi</label>
                        <input type="text" class="form-control" value="{{$user->program_studi->nama}}"
                            spellcheck="disabled" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Angkatan</label>
                        <input type="text" class="form-control" value="{{$user->angkatan}}" spellcheck="disabled"
                            readonly>
                    </div>
                    {{-- <div class="mb-3">
                        @if($user->status == 'Belum registrasi')
                        <label class="form-label">Kartu Registrasi Mahasiswa (KRM) / Bukti Registrasi Online <span
                                style="color:#FF0000">*</span></label>
                        @else
                        <label class="form-label">Kartu Registrasi Mahasiswa (KRM) / Bukti Registrasi Online</label>
                        @endif
                        <div class="d-flex">
                            <div class="w-100">
                                @if($user->status == 'Belum registrasi')
                                <input class="form-control @error('krm') is-invalid @enderror" type="file" name="krm"
                                    required>
                                @else
                                <input class="form-control @error('krm') is-invalid @enderror" type="file" name="krm">
                                @endif
                                <small>*Format file: PDF</small>
                                <br>
                                <small>*Ukuran File Maksimal 2 MB</small>
                                @error('nama_panggilan')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            @if(!empty($user->krm))
                            <div class="ml-2">
                                <a href="{{route('download-krm')}}" class="btn btn-success py-2"
                                    style="margin-top: 1px;"><i class="fa fa-download"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Panggilan <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('nama_panggilan') is-invalid @enderror"
                            name="nama_panggilan"
                            value="{{old('nama_panggilan') ? old('nama_panggilan') : $user->nama_panggilan}}"
                            spellcheck="disabled" required>
                        @error('nama_panggilan')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin <span style="color:#FF0000">*</span></label>
                        <select class="form-control" name="jenis_kelamin">
                            @foreach($jenis_kelamins as $jenis_kelamin)
                            @if(old('jenis_kelamin') == $jenis_kelamin || (empty(old('jenis_kelamin')) &&
                            $user->jenis_kelamin == $jenis_kelamin))
                            <option value="{{$jenis_kelamin}}" selected>{{$jenis_kelamin}}</option>
                            @else
                            <option value="{{$jenis_kelamin}}">{{$jenis_kelamin}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Agama <span style="color:#FF0000">*</span></label>
                        <select class="form-control" name="agama">
                            @foreach($agamas as $agama)
                            @if(old('agama') == $agama || (empty(old('agama')) && $user->agama == $agama))
                            <option value="{{$agama}}" selected>{{$agama}}</option>
                            @else
                            <option value="{{$agama}}">{{$agama}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Golongan Darah <span style="color:#FF0000">*</span></label>
                        <select class="form-control" name="golongan_darah">
                            @foreach($golongan_darahs as $golongan_darah)
                            @if(old('golongan_darah') == $golongan_darah || (empty(old('golongan_darah')) &&
                            $user->golongan_darah == $golongan_darah))
                            <option value="{{$golongan_darah}}" selected>{{$golongan_darah}}</option>
                            @else
                            <option value="{{$golongan_darah}}">{{$golongan_darah}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tempat Lahir <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                            name="tempat_lahir"
                            value="{{old('tempat_lahir') ? old('tempat_lahir') : $user->tempat_lahir}}"
                            spellcheck="disabled" required>
                        @error('tempat_lahir')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir <span style="color:#FF0000">*</span></label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            name="tanggal_lahir"
                            value="{{old('tanggal_lahir') ? old('tanggal_lahir') : $user->tanggal_lahir}}"
                            spellcheck="disabled" required>
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Asal <span style="color:#FF0000">*</span></label>
                        <textarea class="form-control @error('alamat_asal') is-invalid @enderror" rows="3"
                            name="alamat_asal"
                            required>{{old('alamat_asal') ? old('alamat_asal') : $user->alamat_asal}}</textarea>
                        @error('alamat_asal')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Sekarang <span style="color:#FF0000">*</span></label>
                        <textarea class="form-control @error('alamat_sekarang') is-invalid @enderror" rows="3"
                            name="alamat_sekarang"
                            required>{{old('alamat_sekarang') ? old('alamat_sekarang') : $user->alamat_sekarang}}</textarea>
                        @error('alamat_sekarang')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon <span style="color:#FF0000">*</span></label>
                        <input type="tel" class="form-control @error('no_telepon') is-invalid @enderror"
                            name="no_telepon" value="{{old('no_telepon') ? old('no_telepon') : $user->no_telepon}}"
                            spellcheck="disabled">
                        @error('no_telepon')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No HP <span style="color:#FF0000">*</span></label>
                        <input type="tel" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                            value="{{old('no_hp') ? old('no_hp') : $user->no_hp}}" spellcheck="disabled" required>
                        @error('no_hp')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ID Line <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('id_line') is-invalid @enderror" name="id_line"
                            value="{{old('id_line') ? old('id_line') : $user->id_line}}" spellcheck="disabled">
                        @error('id_line')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span style="color:#FF0000">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{old('email') ? old('email') : $user->email}}" spellcheck="disabled" required>
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Asal Sekolah <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror"
                            name="asal_sekolah"
                            value="{{old('asal_sekolah') ? old('asal_sekolah') : $user->asal_sekolah}}"
                            spellcheck="disabled" required>
                        @error('asal_sekolah')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alasan Kuliah <span style="color:#FF0000">*</span></label>
                        <textarea class="form-control @error('alasan_kuliah') is-invalid @enderror" rows="3"
                            name="alasan_kuliah"
                            required>{{old('alasan_kuliah') ? old('alasan_kuliah') : $user->alasan_kuliah}}</textarea>
                        @error('alasan_kuliah')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Minat dan Bakat <span style="color:#FF0000">*</span></label>
                        <textarea class="form-control @error('minat_bakat') is-invalid @enderror" rows="3"
                            name="minat_bakat"
                            required>{{old('minat_bakat') ? old('minat_bakat') : $user->minat_bakat}}</textarea>
                        <small>*Contoh: Kesenian(Tari), Olahraga(Sepak Bola), dst.</small>
                        @error('minat_bakat')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cita-cita <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('cita_cita') is-invalid @enderror"
                            name="cita_cita" value="{{old('cita_cita') ? old('cita_cita') : $user->cita_cita}}"
                            spellcheck="disabled" required>
                        @error('cita_cita')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Idola <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('idola') is-invalid @enderror" name="idola"
                            value="{{old('idola') ? old('idola') : $user->idola}}" spellcheck="disabled" required>
                        @error('idola')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Saudara <span style="color:#FF0000">*</span></label>
                        <input type="number" class="form-control @error('jumlah_saudara') is-invalid @enderror"
                            name="jumlah_saudara"
                            value="{{old('jumlah_saudara') ? old('jumlah_saudara') : $user->jumlah_saudara}}"
                            spellcheck="disabled" required>
                        @error('jumlah_saudara')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Ayah <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                            name="nama_ayah" value="{{old('nama_ayah') ? old('nama_ayah') : $user->nama_ayah}}"
                            spellcheck="disabled" required>
                        @error('nama_ayah')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Ibu <span style="color:#FF0000">*</span></label>
                        <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" name="nama_ibu"
                            value="{{old('nama_ibu') ? old('nama_ibu') : $user->nama_ibu}}" spellcheck="disabled"
                            required>
                        @error('nama_ibu')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div> --}}
                    {{-- <div class="mb-3">
                        <label class="form-label">Konsumsi <span style="color:#FF0000">*</span></label>
                        <select class="form-control" name="konsumsi">
                            @foreach($konsumsis as $konsumsi)
                            @if(old('konsumsi') == $konsumsi || (empty(old('konsumsi')) && $user->konsumsi ==
                            $konsumsi))
                            <option value="{{$konsumsi}}" selected>{{$konsumsi}}</option>
                            @else
                            <option value="{{$konsumsi}}">{{$konsumsi}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="mb-3">
                        <label class="form-label">Penyakit Khusus</label>
                        <textarea class="form-control @error('penyakit_khusus') is-invalid @enderror" rows="3"
                            name="penyakit_khusus">{{old('penyakit_khusus') ? old('penyakit_khusus') : $user->penyakit_khusus}}</textarea>
                        @error('penyakit_khusus')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <div class="form-check">
                            @if($user->organisasi == 'Ya')
                            <input class="form-check-input" type="checkbox" value="1" name="organisasi" checked>
                            @else
                            <input class="form-check-input" type="checkbox" value="1" name="organisasi">
                            @endif
                            <label>
                                Saya memiliki Pengalaman Organisasi
                            </label>
                        </div>
                        <div class="form-check">
                            @if($user->prestasi == 'Ya')
                            <input class="form-check-input" type="checkbox" value="1" name="prestasi" checked>
                            @else
                            <input class="form-check-input" type="checkbox" value="1" name="prestasi">
                            @endif
                            <label>
                                Saya memiliki Prestasi Akademik / Non Akademik
                            </label>
                        </div>
                        <small>* Dengan mencentang pilihan ini, Anda harus mengisi data pada menu organisasi dan/atau
                            prestasi.</small>
                    </div> --}}
                    @if($user->status == 'Belum registrasi')
                    <button style="width:100%;" type="button" data-toggle="modal" data-target="#konfirmasi"
                        class="model_bt btn btn-primary mt-4">Ajukan Registrasi</button>
                    @else
                    <button style="width:100%;" type="button" data-toggle="modal" data-target="#konfirmasi"
                        class="model_bt btn btn-primary mt-4">Ajukan Perbaikan Registrasi</button>
                    @endif
                    <div class="modal fade" id="konfirmasi">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Konfirmasi</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    @if($user->status == 'Belum registrasi')
                                    Mohon periksa kembali data registrasi. Apakah anda yakin ingin mengajukan
                                    registrasi?
                                    @else
                                    Mohon periksa kembali data registrasi. Apakah anda yakin ingin mengajukan perbaikan
                                    registrasi?
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#pas_foto')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@else
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <div class="table_section padding_infor_info">
                <div class="mb-3 d-flex">
                    <div class="">
                        <img src="{{url('mahasiswa/pas_foto/'. $user->pas_foto)}}"
                            style="width:150px; height:200px; display:block;">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" class="form-control" value="{{$user->nim}}" spellcheck="disabled" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{$user->nama_lengkap}}" spellcheck="disabled"
                        readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jalur Pendaftaran</label>
                    <input type="text" class="form-control" value="{{$user->jalur_pendaftaran->nama}}"
                        spellcheck="disabled" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Program Studi</label>
                    <input type="text" class="form-control" value="{{$user->program_studi->nama}}" spellcheck="disabled"
                        readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Angkatan</label>
                    <input type="text" class="form-control" value="{{$user->angkatan}}" spellcheck="disabled" readonly>
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Kartu Registrasi Mahasiswa (KRM) / Bukti Registrasi Online</label>
                    <a href="{{route('download-krm')}}" target="_blank" class="btn btn-success py-2"
                        style="margin-top: 1px; width:100%;"><i class="fa fa-download"> Download KRM / Bukti Registrasi
                            Online</i></a> --}}
                    {{--
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Panggilan</label>
                    <input type="text" class="form-control" value="{{$user->nama_panggilan}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-control" value="{{$user->jenis_kelamin}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Agama</label>
                    <input type="text" class="form-control" value="{{$user->agama}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Golongan Darah</label>
                    <input type="text" class="form-control" value="{{$user->golongan_darah}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" value="{{$user->tempat_lahir}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" value="{{$user->tanggal_lahir}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Asal</label>
                    <textarea class="form-control" rows="3" readonly disabled>{{$user->alamat_asal}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Sekarang</label>
                    <textarea class="form-control" rows="3" readonly disabled>{{$user->alamat_sekarang}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">No Telepon</label>
                    <input type="tel" class="form-control" value="{{$user->no_telepon}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="tel" class="form-control" value="{{$user->no_hp}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">ID Line</label>
                    <input type="text" class="form-control" value="{{$user->id_line}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{$user->email}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Asal Sekolah</label>
                    <input type="text" class="form-control" value="{{$user->asal_sekolah}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alasan Kuliah</label>
                    <textarea class="form-control" rows="3" readonly disabled>{{$user->alasan_kuliah}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Minat dan Bakat</label>
                    <textarea class="form-control" rows="3" readonly disabled>{{$user->minat_bakat}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cita-cita</label>
                    <input type="text" class="form-control" value="{{$user->cita_cita}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Idola</label>
                    <input type="text" class="form-control" value="{{$user->idola}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Saudara</label>
                    <input type="text" class="form-control" value="{{$user->jumlah_saudara}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Ayah</label>
                    <input type="text" class="form-control" value="{{$user->nama_ayah}}" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Ibu</label>
                    <input type="text" class="form-control" value="{{$user->nama_ibu}}" readonly disabled>
                </div> --}}
                {{-- <div class="mb-3">
                    <label class="form-label">Konsumsi</label>
                    <input type="text" class="form-control" value="{{$user->konsumsi}}" readonly disabled>
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">Penyakit Khusus</label>
                    <textarea class="form-control" rows="3" readonly disabled>{{$user->penyakit_khusus}}</textarea>
                    {{--
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        @if($user->organisasi == 'Ya')
                        <input class="form-check-input" type="checkbox" disabled readonly checked>
                        @else
                        <input class="form-check-input" type="checkbox" disabled readonly>
                        @endif
                        <label>
                            Saya memiliki Pengalaman Organisasi
                        </label>
                    </div>
                    <div class="form-check">
                        @if($user->prestasi == 'Ya')
                        <input class="form-check-input" type="checkbox" disabled readonly checked>
                        @else
                        <input class="form-check-input" type="checkbox" disabled readonly>
                        @endif
                        <label>
                            Saya memiliki Prestasi Akademik / Non Akademik
                        </label>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endif
@endsection