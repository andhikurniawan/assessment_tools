<div class="table-responsive">
    <table class="table" id="competencies-table">
        <thead>
            <tr>
            <th>Level</th>
            <th>Deskripsi</th>
            <th>Indikator</th>
            <th colspan="4">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>{{ $behaviour->level }}</td>
            <td>{{ $behaviour->description }}</td>
            <td width="200">{{ $behaviour->indicator }}</td>
                    <td>
                    {!! Form::open(['route' => ['competencies.destroy', $competency->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('competencies.show', [$competency->id]) }}" class='btn btn-primary'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('competencies.edit', [$competency->id]) }}" class='btn btn-warning'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        </tbody>
    </table>
</div>
