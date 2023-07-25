@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="py-2">
                <h2>Registrasi</h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30 padding_40">
            <div class="padding_infor_info">
                <div class="d-flex">
                    <div class="w-100">
                        <div class="input-group">
                            <span class="input-group-text" style="border-top-right-radius:0px; border-bottom-right-radius:0px;"><i class="fa fa-search text-secondary"></i></span>
                            <input class="form-control" type="text" id="search" placeholder="Cari" onkeyup="searchFunction()" />
                        </div>
                    </div>
                    <div class="ml-4">
                        <select class="form-control" id="showRow" onchange="searchFunction()" style="width:150px;">
                            <option selected value="20">Filter Baris</option>
                            <option value="50">Show 50 Data</option>
                            <option value="100">Show 100 Data</option>
                            <option value="0">Show All</option>
                        </select>
                    </div>
                    <div class="ml-4">
                        <select class="form-control" id="showProgramStudi" style="width:200px;" onchange="filterFunction()">
                            <option value="0" selected>Semua Program Studi</option>
                            @foreach($program_studis as $program_studi)
                            @if($program_studi->id == $filter_program_studi)
                            <option value="{{$program_studi->id}}" selected>{{$program_studi->nama}}</option>
                            @else
                            <option value="{{$program_studi->id}}">{{$program_studi->nama}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="ml-4">
                        <select class="form-control" id="showJalurPendaftaran" style="width:225px;" onchange="filterFunction()">
                            <option value="0" selected>Semua Jalur Pendaftaran</option>
                            @foreach($jalur_pendaftarans as $jalur_pendaftaran)
                            @if($jalur_pendaftaran->id == $filter_jalur_pendaftaran)
                            <option value="{{$jalur_pendaftaran->id}}" selected>{{$jalur_pendaftaran->nama}}</option>
                            @else
                            <option value="{{$jalur_pendaftaran->id}}">{{$jalur_pendaftaran->nama}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="ml-4">
                        <select class="form-control" id="showStatus" style="width:250px;" onchange="filterFunction()">
                            <option value="0" selected>Semua Status</option>
                            @foreach($statuses as $status)
                            @if($status == $filter_status)
                            <option value="{{$status}}" selected>{{$status}}</option>
                            @else
                            <option value="{{$status}}">{{$status}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="ml-4">
                        <a href="{{route('admin-view-registrasi').'?program_studi='.$filter_program_studi.'&jalur_pendaftaran='.$filter_jalur_pendaftaran.'&status='.$filter_status}}"><button type="button" class="btn btn-outline-secondary m-0" id="btn-refresh" style="float:right;"><i class="fa fa-refresh text-secondary"></i></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <div class="table_section padding_infor_info">
                <div class="table-responsive-sm"> <!--  <div class="table-responsive-sm" style="min-width:max-content"> -->
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Program Studi</th>
                                <th>Jalur Pendaftaran</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswas as $mahasiswa)
                            <tr>
                                <td class="text-center">{{$loop->index+1}}</td>
                                <td>{{$mahasiswa->nim}}</td>
                                <td>{{$mahasiswa->nama_lengkap}}</td>
                                <td>{{$mahasiswa->program_studi->nama}}</td>
                                <td>{{$mahasiswa->jalur_pendaftaran->nama}}</td>
                                <td>{{$mahasiswa->status}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#biodata-modal-{{$loop->index+1}}"><i class="fa fa-pencil text-white"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    @foreach($mahasiswas as $mahasiswa)
    <div class="modal fade" id="biodata-modal-{{$loop->index+1}}">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a type="button" class="nav-link active" style="cursor: pointer;">Biodata</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#konfirmasi-modal-{{$loop->index+1}}" data-dismiss="modal">Konfirmasi</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#file-verifikasi-modal-{{$loop->index+1}}" data-dismiss="modal">File Verifikasi</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
                    <div class="mb-3">
                        <div>
                            @if(!empty($mahasiswa->pas_foto))
                            <img src="{{url('mahasiswa/pas_foto/'. $mahasiswa->pas_foto)}}" style="width:150px; height:200px; display:block; margin-left:auto; margin-right:auto;">
                            @else
                            <img src="{{url('img/foto3x4.jpg')}}" style="width:150px; height:200px; display:block; margin-left:auto; margin-right:auto;">
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->nim}}" spellcheck="disabled" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->nama_lengkap}}" spellcheck="disabled" readonly>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Jalur Pendaftaran</label>
                            <input type="text" class="form-control" value="{{$mahasiswa->jalur_pendaftaran->nama}}" spellcheck="disabled" readonly>
                        </div>
                        <div class="col">
                            <label class="form-label">Program Studi</label>
                            <input type="text" class="form-control" value="{{$mahasiswa->program_studi->nama}}" spellcheck="disabled" readonly>
                        </div>
                        <div class="col-2">
                            <label class="form-label">Angkatan</label>
                            <input type="text" class="form-control" value="{{$mahasiswa->angkatan}}" spellcheck="disabled" readonly>
                        </div>
                    </div>
                    @if($mahasiswa->koordinator)
                    <div class="mb-3">
                        <label class="form-label">Koordinator</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->koordinator}}" spellcheck="disabled" readonly>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->status}}" spellcheck="disabled" readonly>
                    </div>
                    @if(!empty($mahasiswa->krm))
                    <div class="mb-3">
                        <label class="form-label">Kartu Registrasi Mahasiswa (KRM) / Bukti Registrasi Online</label>
                        <a href="{{route('admin-download-krm-registrasi', ['id' => $mahasiswa->id])}}" target="_blank" class="btn btn-success py-2" style="margin-top: 1px; width:100%;"><i class="fa fa-download"> Download KRM / Bukti Registrasi Online</i></a>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Nama Panggilan</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->nama_panggilan}}" readonly disabled>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" value="{{$mahasiswa->jenis_kelamin}}" readonly disabled>
                        </div>
                        <div class="col">
                            <label class="form-label">Agama</label>
                            <input type="text" class="form-control" value="{{$mahasiswa->agama}}" readonly disabled>
                        </div>
                        <div class="col">
                            <label class="form-label">Golongan Darah</label>
                            <input type="text" class="form-control" value="{{$mahasiswa->golongan_darah}}" readonly disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" value="{{$mahasiswa->tempat_lahir}}" readonly disabled>
                        </div>
                        <div class="col">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" value="{{$mahasiswa->tanggal_lahir}}" readonly disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Asal</label>
                        <textarea class="form-control" rows="3" readonly disabled>{{$mahasiswa->alamat_asal}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Sekarang</label>
                        <textarea class="form-control" rows="3" readonly disabled>{{$mahasiswa->alamat_sekarang}}</textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">No Telepon</label>
                            <input type="tel" class="form-control" value="{{$mahasiswa->no_telepon}}" readonly disabled>
                        </div>
                        <div class="col">
                            <label class="form-label">No HP</label>
                            <input type="tel" class="form-control" value="{{$mahasiswa->no_hp}}" readonly disabled>
                        </div>
                        <div class="col">
                            <label class="form-label">ID Line</label>
                            <input type="text" class="form-control" value="{{$mahasiswa->id_line}}" readonly disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{$mahasiswa->email}}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Asal Sekolah</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->asal_sekolah}}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alasan Kuliah</label>
                        <textarea class="form-control" rows="3" readonly disabled>{{$mahasiswa->alasan_kuliah}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Minat dan Bakat</label>
                        <textarea class="form-control" rows="3" readonly disabled>{{$mahasiswa->minat_bakat}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cita-cita</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->cita_cita}}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Idola</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->idola}}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Saudara</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->jumlah_saudara}}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Ayah</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->nama_ayah}}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Ibu</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->nama_ibu}}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konsumsi</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->konsumsi}}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penyakit Khusus</label>
                        <textarea class="form-control" rows="3" readonly disabled>{{$mahasiswa->penyakit_khusus}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pengalaman Organisasi</label>
                        @if($mahasiswa->organisasi == 'Ya')
                        <div class="table-responsive-sm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($mahasiswa->organisasis as $organisasi)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$organisasi->nama}}</td>
                                        <td>{{$organisasi->jabatan}}</td>
                                        <td>{{$organisasi->tahun}}</td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <input type="text" class="form-control" value="Tidak ada" readonly disabled>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prestasi</label>
                        @if($mahasiswa->prestasi == 'Ya')
                        <div class="table-responsive-sm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Tingkat</th>
                                        <th>Tahun</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($mahasiswa->prestasis as $prestasi)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$prestasi->nama}}</td>
                                        <td>{{$prestasi->tingkat}}</td>
                                        <td>{{$prestasi->tahun}}</td>
                                        <td class="text-center">
                                            <a type="button" class="btn btn-success" href="{{route('admin-download-prestasi-registrasi', ['id' => $prestasi->id])}}" target="_blank"><i class="fa fa-download text-white"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <input type="text" class="form-control" value="Tidak ada" readonly disabled>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="konfirmasi-modal-{{$loop->index+1}}">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a type="button" class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#biodata-modal-{{$loop->index+1}}" data-dismiss="modal">Biodata</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="nav-link active" style="cursor: pointer;">Konfirmasi</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#file-verifikasi-modal-{{$loop->index+1}}" data-dismiss="modal">File Verifikasi</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="{{$mahasiswa->status}}" spellcheck="disabled" readonly>
                    </div>
                    @if($mahasiswa->status == 'Mengajukan registrasi' || $mahasiswa->status == 'Mengajukan perbaikan registrasi')
                    <form method="POST" action="{{route('admin-note-registrasi', ['id' => $mahasiswa->id])}}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Note</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" rows="3" name="note" required>{{old('note')}}</textarea>
                            <small>*Maksimal 1000 Karakter.</small>
                            @error('note')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <button type="submit" class="btn btn-warning text-white" style="width:100%">Kirim Note</button>
                            </div>
                            <div class="col">
                                <a type="button" href="{{route('admin-konfirmasi-registrasi', ['id' => $mahasiswa->id])}}" class="btn btn-primary text-white" style="width:100%">Konfirmasi Registrasi</a>
                            </div>
                        </div>
                    </form>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Daftar Note</label>
                        @if(!empty($mahasiswa->notes) && count($mahasiswa->notes) > 0)
                        <div class="table-responsive-sm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Note</th>
                                        <th>Waktu Kirim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($mahasiswa->notes as $note)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$note->note}}</td>
                                        <td>{{Carbon\Carbon::parse($note->created_at)->format('H:i:s d-m-Y')}}</td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <input type="text" class="form-control" value="Tidak ada" readonly disabled>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="file-verifikasi-modal-{{$loop->index+1}}">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a type="button" class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#biodata-modal-{{$loop->index+1}}" data-dismiss="modal">Biodata</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#konfirmasi-modal-{{$loop->index+1}}" data-dismiss="modal">Konfirmasi</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="nav-link active" style="cursor: pointer;">File Verifikasi</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
                    <div class="">
                        @if($mahasiswa->status == "Teregistrasi")
                            <a href="{{route('admin-download-biodata-registrasi', ['id' => $mahasiswa->id])}}" type="button" class="btn btn-success" target="_blank" style="width:100%;"><i class="fa fa-download"> Download Form Verifikasi Mahasiswa</i></a>
                        @else
                            <input type="text" class="form-control" value="{{'Mahasiswa belum Teregistrasi Student Day '.date('Y')}}" spellcheck="disabled" readonly>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
    function filterFunction() {
        let program_studi = document.getElementById('showProgramStudi').value;
        let jalur_pendaftaran = document.getElementById('showJalurPendaftaran').value;
        let status = document.getElementById('showStatus').value;
        let url = "{{route('admin-view-registrasi')}}"+"?program_studi="+program_studi+"&jalur_pendaftaran="+jalur_pendaftaran+"&status="+status;
        window.location.href = url;
    }

    function searchFunction() {
        var input, filter, table, tr, i, r, txtValue, td = [],
            check = [],
            row, displayedRow;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");
        row = document.getElementById("showRow").value;
        displayedRow = 0;
        for (i = 1; i < tr.length; i++) {
            td[0] = tr[i].getElementsByTagName("td")[0];
            td[1] = tr[i].getElementsByTagName("td")[1];
            td[2] = tr[i].getElementsByTagName("td")[2];
            td[3] = tr[i].getElementsByTagName("td")[3];
            td[4] = tr[i].getElementsByTagName("td")[4];
            td[5] = tr[i].getElementsByTagName("td")[5];
            if (td[0]) {
                txtValue = td[0].textContent || td[0].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    check[0] = 1;
                } else {
                    check[0] = 0;
                }
            }
            if (td[1]) {
                txtValue = td[1].textContent || td[1].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    check[1] = 1;
                } else {
                    check[1] = 0;
                }
            }
            if (td[2]) {
                txtValue = td[2].textContent || td[2].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    check[2] = 1;
                } else {
                    check[2] = 0;
                }
            }
            if (td[3]) {
                txtValue = td[3].textContent || td[3].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    check[3] = 1;
                } else {
                    check[3] = 0;
                }
            }
            if (td[4]) {
                txtValue = td[4].textContent || td[4].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    check[4] = 1;
                } else {
                    check[4] = 0;
                }
            }
            if (td[5]) {
                txtValue = td[5].textContent || td[5].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    check[5] = 1;
                } else {
                    check[5] = 0;
                }
            }
            if (check[0] == 1 || check[1] == 1 || check[2] == 1 || check[3] == 1 || check[4] == 1 || check[5] == 1) {
                tr[i].style.display = "";
                displayedRow++;
            } else {
                tr[i].style.display = "none";
            }
            if (displayedRow > row && row > 0) {
                tr[i].style.display = "none";
            }
        }
    }
    searchFunction();
</script>
@endsection