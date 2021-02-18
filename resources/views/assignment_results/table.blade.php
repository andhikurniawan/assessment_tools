

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Employee Id</th>
                        <th>Job Target Id</th>
                        <th>Jobcode</th>
                        <th>Header Id</th>
                        <th>Team Id</th>
                        <th>Gap</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($assignmentResults->sortBy('team') as $assignmentResult)
                    <tr>
                    <td>{!! (empty($assignmentResult->user)? $assignmentResult->employee_id :  $assignmentResult->user->name . '('.$assignmentResult->employee_id.')') !!}</td>
                    <td>{!! $assignmentResult->job_target_id !!}</td>
                    <td>{!! $assignmentResult->jobcode !!}</td>
                    <td>{!! (empty($assignmentResult->header)? '-' : $assignmentResult->header->assessmentName()) !!}</td>
                    <td>{!! (empty($assignmentResult->team) ? '-' : $assignmentResult->team->name)  !!}</td>
                    <td>{!! $assignmentResult->gap !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection