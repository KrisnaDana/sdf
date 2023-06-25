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
                                    <a href="{{route('admin-read-akun-mahasiswa', ['id' => $mahasiswa->id])}}"><button type="button" class="btn btn-primary"><i class="fa fa-book text-white"></i></button></a>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#reset-password-modal{{$loop->index+1}}"><i class="fa fa-key text-white"></i></button>
                                    <a href="{{route('admin-view-edit-akun-mahasiswa', ['id' => $mahasiswa->id])}}"><button type="button" class="btn btn-warning"><i class="fa fa-pencil-square text-white"></i></button></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="reset-password-modal{{$loop->index+1}}">
                                <form method="get" action="{{route('admin-reset-password-akun-mahasiswa', ['id' => $mahasiswa->id])}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin mereset password akun mahasiswa {{$mahasiswa->nim}} - {{$mahasiswa->nama_lengkap}}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ya</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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