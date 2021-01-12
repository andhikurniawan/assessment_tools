<div class="table-responsive" style="margin-top:10px">
    <table class="table table-striped" id="table_id">
        <thead>
            <tr>
                <th>Name</th>
        <th>Category</th>
        <th>Status</th>
        <th>Expired</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Company Id</th>
        <th>Action</th>
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
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">

$(document).ready(function(){

    $('#table_id').DataTable({
        
    });



});

</script>
