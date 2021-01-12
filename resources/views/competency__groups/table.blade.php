<div class="table-responsive">
    <table class="table" id="competencyGroups-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Perusahaan</th>
                <th>Grup Kompetensi</th>
                <th>Deskripsi</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($competencyGroups as $competencyGroup)
            <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $competencyGroup->company['name'] }}</td>
            <td>{{ $competencyGroup->name }}</td>
            <td width="500">{{ $competencyGroup->description }}</td>
                <td>
                    {!! Form::open(['route' => ['competencyGroups.destroy', $competencyGroup->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    
                        <a href="{{ route('competencyGroups.edit', [$competencyGroup->id]) }}" class='btn btn-warning'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
