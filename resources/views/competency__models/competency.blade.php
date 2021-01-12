<div class="table-responsive">
    <table class="table" id="competencies-table">
        <thead>
            <tr>
            <th>Nama</th>
            <th>Kode</th>
            <th>Deskripsi</th>
            <th colspan="4">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($competencyRelation as $data)
            <tr>
            <td>{{ $data->competency->name }}</td>
            <td>{{ $data->competency->code }}</td>
            <td width="200">{{ $data->competency->indicator }}</td>
                    <td>
                    {!! Form::open(['route' => ['competencies.destroy', $data->competency->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('competencies.show', [$data->competency->id]) }}" class='btn btn-primary'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('competencies.edit', [$data->competency->id]) }}" class='btn btn-warning'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
