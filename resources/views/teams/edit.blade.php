@extends('main')

@section('title', 'Job Targets')

@section('JobTargets', 'active')

@section('content')
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url('jobTargets') }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Edit Team</h1>
        </div>
    </div>

   <div class="card shadow mb-4">
        <div class="card-body">
        {!! Form::model($team, ['route' => ['teams.update', $team->id], 'method' => 'patch']) !!}

        @include('teams.fields')

        {!! Form::close() !!}
        </div>
    </div>
@endsection