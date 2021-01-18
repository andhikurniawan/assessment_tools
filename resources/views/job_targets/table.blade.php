<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Job Target</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Team</th>
                        <th>Job Name</th>
                        <th>Job Code</th>
                        <th>Number Position</th>
                        <th>Assessment Session</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobTargets as $jobTarget)
                        <tr>
                            <td>{!! (empty($jobTarget->team) ? '-' :  $jobTarget->team->name ) !!}</td>
                            <td>{!! $jobTarget->job_name !!}</td>
                            <td>{!! $jobTarget->job_code !!}</td>
                            <td>{!! $jobTarget->number_position !!}</td>
                            <td>{!! (empty($jobTarget->assessmentSession) ? '-' :  $jobTarget->assessmentSession->name ) !!}</td>
                            <td>
                                {!! Form::open(['route' => ['jobTargets.destroy', $jobTarget->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! route('jobRequirements.index', ['job_target_id'=>$jobTarget->id]) !!}" class='btn btn-info btn-xs'>Requirement</a>
                                    <a class='btn btn-success btn-xs'><span class="iconify" data-icon="ant-design:copy-outlined" data-inline="false"></span></a>
                                    <a href="{!! route('jobTargets.show', [$jobTarget->id]) !!}" class='btn btn-success btn-xs'><span class="iconify" data-icon="bx:bx-show" data-inline="false"></span></a>
                                    <a href="{!! route('jobTargets.edit', [$jobTarget->id]) !!}" class='btn btn-secondary btn-xs'><span class="iconify" data-icon="ant-design:edit-outlined" data-inline="false"></span></a>
                                    {!! Form::button('<span class="iconify" data-icon="ant-design:delete-outlined" data-inline="false"></span>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

