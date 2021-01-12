<div class="table-responsive">
    <table class="table" id="competencyModels-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Model</th>
                <th>Deskripsi</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($competencyModels as $competencyModel)
            <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $competencyModel->name }}</td>
            <td>{{ $competencyModel->description }}</td>
                <td>
                    {!! Form::open(['route' => ['competencyModels.destroy', $competencyModel->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    <a href="{{ route('competencyModels.show', [$competencyModel->id]) }}" class='btn btn-primary'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('competencyModels.edit', [$competencyModel->id]) }}" class='btn btn-warning'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
