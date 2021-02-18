@extends('main')

@section('title', 'Job Requirements')

@section('JobRequirement', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Job Requirement for {{ $jobTarget->job_name }}</h1>
        <!-- <div class="text-right">
            <a href="{{ url('jobTargets/create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Buat Job Target</a>
        </div> -->
    </div>

    <div class="block">
        <div class="block-content">
            <table class="table table-striped">
                <tr>
                    <th>Company</th>
                    <td>{{ $jobTarget->assessmentSession->company->name }}</td>
                </tr>
                <tr>
                    <th>Assessment Session</th>
                    <td>{{ $jobTarget->assessmentSession->name }}</td>
                </tr>
                <tr>
                    <th>Job Target</th>
                    <td>{{ $jobTarget->job_name }}</td>
                </tr>
            </table>

            <div class="block-option">
                <a class="btn btn-rounded btn-primary min-width-125 mb-10 float-right" style="margin-bottom: 20px" href="{!! route('jobRequirements.create', ['job_target_id' => $jobTarget->id]) !!}">New Requirement</a>
            </div>
            <div class="clearfix"></div>

            @include('flash::message')

            <div class="clearfix"></div>
            
            @include('job_requirements.table')
            <div class="text-center">
            
            </div>
            <div class="row" style="padding-left: 20px">
                <a href="{!! route('jobTargets.index') !!}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection
