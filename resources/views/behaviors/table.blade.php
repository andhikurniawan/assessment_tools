<div class="table-responsive">
    <table class="table" id="behaviors-table">
        <thead>
            <tr>
                <th>Level</th>
        <th>Description</th>
        <th>Indicator</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($behaviors as $behavior)
            <tr>
                <td>{{ $behavior->level }}</td>
            <td>{{ $behavior->description }}</td>
            <td>{{ $behavior->indicator }}</td>
                <td>
                    {!! Form::open(['route' => ['behaviors.destroy', $behavior->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('behaviors.show', [$behavior->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('behaviors.edit', [$behavior->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
