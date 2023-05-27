@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="py-2">
                <h2>Berkas</h2>
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
                    <a href="{{route('view-berkas')}}"><button type="button" class="btn btn-outline-secondary m-0" id="btn-refresh" style="float:right;"><i class="fa fa-refresh text-secondary"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <div class="table_section padding_infor_info">
                <div class="table-responsive-sm">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Biodata</td>
                                <td class="text-center">
                                    <a href="{{route('download-biodata')}}" target="_blank"><button type="button" class="btn btn-success"><i class="fa fa-download text-white"></i></button></a>
                                </td>
                            </tr>
                            @foreach($berkas as $b)
                            <tr>
                                <td>{{$loop->index+2}}</td>
                                <td>{{$b->nama}}</td>
                                <td class="text-center">
                                    <a href="{{route('read-berkas', ['id' => $b->id])}}"><button type="button" class="btn btn-primary"><i class="fa fa-book text-white"></i></button></a>
                                    <a href="{{route('download-berkas', ['id' => $b->id])}}" target="_blank"><button type="button" class="btn btn-success"><i class="fa fa-download text-white"></i></button></a>
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
            if (check[0] == 1 || check[1] == 1) {
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