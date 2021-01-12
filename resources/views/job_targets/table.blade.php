<div class="table-responsive">
    <table class="table table-bordered table-striped" id="jobTargets-table">
        <thead>
            <tr>
                <th>Team</th>
                <th>Job Name</th>
                <th>Job Code</th>
                <th>Number Position</th>
                <th>Assessment Session</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($jobTargets as $jobTarget)
            <tr>
                <td>{!! (empty($jobTarget->team) ? '-' :  $jobTarget->team->name ) !!}</td>
                <td>{!! $jobTarget->job_name !!}</td>
                <td>{!! $jobTarget->job_code !!}</td>
                <td>{!! $jobTarget->number_position !!}</td>
                <td>Session</td>
                <td>
                    {!! Form::open(['route' => ['jobTargets.destroy', $jobTarget->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a class='btn btn-info btn-xs'>Requirement</a>
                        <a class='btn btn-success btn-xs'><i class="si si-docs"></i></a>
                        <a href="{!! route('jobTargets.show', [$jobTarget->id]) !!}" class='btn btn-success btn-xs'><i class="si si-eye"></i></a>
                        <a href="{!! route('jobTargets.edit', [$jobTarget->id]) !!}" class='btn btn-secondary btn-xs'><i class="si si-pencil"></i></a>
                        {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
