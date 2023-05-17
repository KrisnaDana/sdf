@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
        <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Akun Mahasiswa</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-create-akun-mahasiswa')}}"><button type="button" class="btn cur-p btn-lg btn-success mr-3" style="float: right;">Tambah</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30 padding_40">
            <div class="padding_infor_info" style="display:flex;">
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" style="border-top-right-radius:0px; border-bottom-right-radius:0px;"><i class="fa fa-search text-secondary"></i></span>
                        <input class="form-control" type="text" id="search" placeholder="Cari" onkeyup="searchFunction()" />
                    </div>
                </div>
                <div class="col">
                    <select class="form-control" id="showRow" onchange="searchFunction()" style="max-width:fit-content">
                        <option selected value="20">Filter</option>
                        <option value="50">Show 50 Data</option>
                        <option value="100">Show 100 Data</option>
                        <option value="0">Show All</option>
                    </select>
                </div>
                <div class="col">
                    <a href="{{route('admin-view-akun-mahasiswa')}}"><button type="button" class="btn btn-outline-secondary m-0" id="btn-refresh" style="float:right;"><i class="fa fa-refresh text-secondary"></i></button></a>
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
                                <th>No.</th>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Program Studi</th>
                                <th>Ganti Password</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswas as $mahasiswa)
                            @for($i=0;$i<30;$i++)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$mahasiswa->nim}}</td>
                                <td>{{$mahasiswa->nama_lengkap}}</td>
                                <td>{{$mahasiswa->program_studi->nama}}</td>
                                <td>{{$mahasiswa->ganti_password}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin-read-akun-mahasiswa', ['id' => $mahasiswa->id])}}"><button type="button" class="btn btn-primary"><i class="fa fa-book text-white"></i></button></a>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#reset-password-modal{{$loop->index+1}}"><i class="fa fa-key text-white"></i></button>
                                    <a href="{{route('admin-view-edit-akun-mahasiswa', ['id' => $mahasiswa->id])}}"><button type="button" class="btn btn-warning"><i class="fa fa-pencil-square text-white"></i></button></a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal{{$loop->index+1}}"><i class="fa fa-trash-o text-white"></i></button>
                                </td>
                            </tr>
                            @endfor
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
                            <div class="modal fade" id="delete-modal{{$loop->index+1}}">
                                <form method="post" action="{{route('admin-delete-akun-mahasiswa', ['id' => $mahasiswa->id])}}">
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus mahasiswa {{$mahasiswa->nim}} - {{$mahasiswa->nama_lengkap}}?
                                                <input type="text" class="form-control mt-3" name="nim" spellcheck="disabled" required placeholder="Ketik NIM mahasiswa untuk konfirmasi">
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
            if (check[0] == 1 || check[1] == 1 || check[2] == 1 || check[3] == 1 || check[4] == 1) {
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