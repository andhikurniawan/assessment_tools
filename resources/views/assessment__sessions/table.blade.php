<div class="table-responsive">
    <table class="table" id="assessmentSessions-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Category</th>
        <th>Status</th>
        <th>Expired</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Company Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assessmentSessions as $assessmentSession)
            <tr>
                <td>{{ $assessmentSession->name }}</td>
            <td>{{ $assessmentSession->category }}</td>
            <td>{{ $assessmentSession->status }}</td>
            <td>{{ $assessmentSession->expired }}</td>
            <td>{{ $assessmentSession->start_date }}</td>
            <td>{{ $assessmentSession->end_date }}</td>
            <td>{{ $assessmentSession->company_id }}</td>
                <td>
                    {!! Form::open(['route' => ['assessmentSessions.destroy', $assessmentSession->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('assessmentSessions.show', [$assessmentSession->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('assessmentSessions.edit', [$assessmentSession->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
