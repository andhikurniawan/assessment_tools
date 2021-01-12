@extends('main')

@section('title', 'Job Requirements')

@section('JobRequirement', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{!! route('jobRequirements.index', ['job_target_id'=>$job_target_id]) !!}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Buat Job Requirement</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
        {!! Form::open(['route' => 'jobRequirements.store']) !!}

        @include('job_requirements.fields')

        {!! Form::close() !!}
        </div>
    </div>
@endsection
