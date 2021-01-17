<div class="table-responsive">
    <table class="table" id="competencies-table">
        <thead>
            <tr>
            <th>Level</th>
            <th>Deskripsi</th>
            <th colspan="4">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($behaviour as $data)
            <tr>
            <td>{{ $data->level }}</td>
            <td>{{ $data->description }}</td>
                    <td>
                    {!! Form::open(['route' => ['competencies.destroy', $data->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('competencies.show', [$data->id]) }}" class='btn btn-primary'><span class="iconify" data-icon="bi:eye-fill" data-inline="false"></span></a>
                        <a href="{{ route('competencies.edit', [$data->id]) }}" class='btn btn-warning'><span class="iconify" data-icon="bx:bx-edit" data-inline="false"></span></a>
                        {!! Form::button('<span class="iconify" data-icon="bi:trash" data-inline="false"></span>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
