@extends('layout.layout')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="py-2">
                <h2>Dashboard</h2>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-wrap">
    @foreach($program_studis as $program_studi)
    <div class="card text-white bg-primary mb-3 mr-3" style="width: 30rem;">
        <div class="card-header">
            {{$program_studi->nama}}
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">Belum registrasi: 100</li>
            <li class="list-group-item">Menunggu konfirmasi registrasi: 200</li>
            <li class="list-group-item">Perbaikan registrasi: 300</li>
            <li class="list-group-item">Teregistrasi: 300</li>
            <li class="list-group-item">Total: 300</li>
        </ul>
    </div>
    @endforeach
    <div class="card text-white bg-primary mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
    <div class="card text-white bg-success mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
    <div class="card text-white bg-warning mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
    <div class="card text-white bg-danger mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
    <div class="card text-white bg-info mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
    <div class="card text-white bg-primary mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
    <div class="card text-white bg-primary mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
    <div class="card text-white bg-primary mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
    <div class="card text-white bg-primary mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
    <div class="card text-white bg-primary mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
    <div class="card text-white bg-primary mb-3 mr-3" style="width: 18rem;">
        <div class="card-header">
            Teknik Test
        </div>
        <ul class="list-group list-group-flush text-dark">
            <li class="list-group-item">SNMPTN: 100</li>
            <li class="list-group-item">SBMPTN: 200</li>
            <li class="list-group-item">Mahasiswa Lama: 300</li>
        </ul>
    </div>
</div>
@endsection