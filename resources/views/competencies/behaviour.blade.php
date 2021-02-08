<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>Level</th>
            <th>Deskripsi</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($behaviour as $data)
            <tr>
            <td>{{ $data->level }}</td>
            <td>{{ $data->description }}</td>
                    <td>
                    {!! Form::open(['route' => ['keyBehaviours.destroy', $data->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                         <a href="{{ route('keyBehaviours.edit', [$data->id]) }}" class='btn btn-warning'><span class="iconify" data-icon="bx:bx-edit" data-inline="false"></span></a>
                        {!! Form::button('<span class="iconify" data-icon="bi:trash" data-inline="false"></span>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a  style="margin-left: 5px" href="{{ route('keyBehaviours.create') }}">Tambah Key Behaviour</a>   
</div>
