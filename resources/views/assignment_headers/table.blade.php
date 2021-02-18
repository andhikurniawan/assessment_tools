<div class="table-responsive">
    <table class="table" id="assignmentHeaders-table">
        <thead>
            <tr>
                <th>Assessment Session Id</th>
        <th>Run Counter</th>
        <th>Run Date</th>
        <th>Is Effective</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assignmentHeaders as $assignmentHeader)
            <tr>
                <td>{!! $assignmentHeader->assessment_session_id !!}</td>
            <td>{!! $assignmentHeader->run_counter !!}</td>
            <td>{!! $assignmentHeader->run_date !!}</td>
            <td>{!! $assignmentHeader->is_effective !!}</td>
                <td>
                    {!! Form::open(['route' => ['assignmentHeaders.destroy', $assignmentHeader->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('assignmentHeaders.show', [$assignmentHeader->id]) !!}" class='btn btn-sm btn-secondary fa fa-eye'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('assignmentHeaders.edit', [$assignmentHeader->id]) !!}" class='btn btn-sm btn-secondary fa fa-pencil'></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-secondary fa fa-times', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
