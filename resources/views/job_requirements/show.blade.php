@extends('main')

@section('title', 'Job Requirements')

@section('JobRequirement', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{!! route('jobRequirements.index', ['job_target_id'=>$jobRequirement->job_target_id]) !!}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Detail Job Requirement</h1>
        </div>
    </div>

    <div class="block">
        <div class="block-content">
            <table class="table table-striped">
                <tr>
                    <th>Company</th>
                    <td>{{ $jobRequirement->jobTarget->assessmentSession->company->name }}</td>
                </tr>
                <tr>
                    <th>Assessment Session</th>
                    <td>{{ $jobRequirement->jobTarget->assessmentSession->name }}</td>
                </tr>
                <tr>
                    <th>Job Target</th>
                    <td>{{ $jobRequirement->jobTarget->job_name }}</td>
                </tr>
                <tr>
                    <th>Competency Required</th>
                    <td>{{ $jobRequirement->competency->code }}</td>
                </tr>
                <tr>
                    <th>Skill Level</th>
                    <td>{{ $jobRequirement->skill_level }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ \Carbon\Carbon::parse($jobRequirement->created_at)->format('d M Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ \Carbon\Carbon::parse($jobRequirement->upadted_at)->format('d M Y H:i:s') }}</td>
                </tr>
            </table>
            <div class="row" style="padding-left: 20px">
                <a href="{!! route('jobRequirements.index', ['job_target_id'=>$jobRequirement->job_target_id]) !!}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@endsection
