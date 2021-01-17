<div class="table-responsive">
    <table class="table" id="keyBehaviours-table">
        <thead>
            <tr>
        <th>No</th>
        <th>Level</th>
        <th>Description</th>
        <th>Indicator</th>
        <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($keyBehaviours as $keyBehaviour)
            <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $keyBehaviour->level }}</td>
            <td width="400">{{ $keyBehaviour->description }}</td>
            <td width="400">{{ $keyBehaviour->indicator }}</td>
                <td>
                    {!! Form::open(['route' => ['keyBehaviours.destroy', $keyBehaviour->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('keyBehaviours.edit', [$keyBehaviour->id]) }}" class='btn btn-warning'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
