<div class="table-responsive">
    <table class="table" id="competencyModels-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Description</th>
        <th>Company Id</th>
        <th>Competency Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($competencyModels as $competencyModels)
            <tr>
                <td>{{ $competencyModels->name }}</td>
            <td>{{ $competencyModels->description }}</td>
            <td>{{ $competencyModels->company_id }}</td>
            <td>{{ $competencyModels->competency_id }}</td>
                <td>
                    {!! Form::open(['route' => ['competencyModel.destroy', $competencyModels->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('competencyModel.show', [$competencyModels->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('competencyModel.edit', [$competencyModels->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
