@extends('main')

@section('title', 'Teams')

@section('Teams', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url('jobTargets') }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Buat Team</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            {!! Form::open(['route' => 'teams.store']) !!}

            @include('teams.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
