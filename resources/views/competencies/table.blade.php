<div class="table-responsive">
    <table class="table" id="competencies-table">
        <thead>
            <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Grup Kompetensi</th>
            <th>Nama</th>
            <th>Tipe</th>
            <th>Pertanyaan</th>
            <th colspan="4">Action</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($competencies as $competency)
            <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $competency->code }}</td>
            <td>{{ $competency->competencyGroup['name'] }}</td>
            <td width="100">{{ $competency->name }}</td>
            <td>{{ $competency->type }}</td>
            <td width="300">{{ $competency->question }}</td>
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
        @endforeach
        </tbody>
    </table>
</div>
