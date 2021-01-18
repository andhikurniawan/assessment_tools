@extends('main')

@section('title', 'Job Targets')

@section('JobTargets', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url('jobTargets') }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Edit Job Target</h1>
        </div>
    </div>

   <div class="card shadow mb-4">
        <div class="card-body">
        {!! Form::model($jobTargets, ['route' => ['jobTargets.update', $jobTargets->id], 'method' => 'patch']) !!}

        @include('job_targets.fields2')

        {!! Form::close() !!}
        </div>
    </div>
@endsection