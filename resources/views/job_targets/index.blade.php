@extends('main')

@section('title', 'Job Targets')

@section('JobTargets', 'active')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Job Targets</h1>
        <div class="text-right">
            <a href="{{ url('jobTargets/create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Buat Job Target</a>
        </div>
    </div>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('job_targets.table')
            </div>
        </div>
        <div class="text-center">
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable({
                "pageLength":5
            });
        } );
    </script>

    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection


