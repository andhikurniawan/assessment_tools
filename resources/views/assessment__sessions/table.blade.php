 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
        <th>Status</th>
        <th>Expired</th>
        <th>Company</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assessmentSessions as $assessmentSession)
            <tr>
                <td>{{ $assessmentSession->name }}</td>
            <td>{{ $assessmentSession->status }}</td>
            <td>{{ $assessmentSession->expired }}</td>
            <td>{{ $assessmentSession->company_name}}</td>
            <td>{{ $assessmentSession->start_date }}</td>
            <td>{{ $assessmentSession->end_date }}</td>
                <td>
                {!! Form::open(['route' => ['assessmentSessions.destroy', $assessmentSession->id], 'method' => 'delete', 'id' => "formdelete-$assessmentSession->id"]) !!}
                    <div class='btn-group'>
                        <a href="{{ route('assessmentSessions.show', [$assessmentSession->id]) }}" class="badge badge-info">Detail</a>
                        <a href="{{ route('assessmentSessions.edit', [$assessmentSession->id]) }}" class="badge badge-warning">Edit</a>
                        {!! Form::button('Hapus', ['type' => 'submit', 'class' => 'badge badge-danger btn-delete', 'id' => $assessmentSession->id]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script type="text/javascript">

    $(document).ready(function(){

        $(document).on("click", "button.btn-delete", function(e){

            e.preventDefault();

            var form = $(this).parents('form');

            swal({
                title: "",
                className: "sweartalert",
                text: "Apakah kamu yakin untuk menghapus session ini?",
                icon: "warning",
                buttons: [
                    'No',
                    'Yes'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {

                if(isConfirm)
                {
                    form.submit();
                }
            })

            
        });
    });


</script>

