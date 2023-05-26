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
    <p hidden>{{$loop->index}}</p>
    <div class="card text-white bg-primary mb-3 mr-3" style="width:fit-content;">
        <div class="card-header">
            {{$program_studi->nama}}
        </div>
        <ul class="list-group list-group-flush text-dark">
            @foreach($statuses as $status)
            <li class="list-group-item">{{$status}}: {{$information[$loop->parent->index][$loop->index]}}</li>
            @endforeach
            <li class="list-group-item">Total mahasiswa: {{$total[$loop->index]}}</li>
        </ul>
    </div>
    @endforeach
</div>
@endsection