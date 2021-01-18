<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Grup Kompetensi</th>
            <th>Nama</th>
            <th>Tipe</th>
            <th>Pertanyaan</th>
            <th>Action</th>
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
                        <a href="{{ route('competencies.show', [$competency->id]) }}" class='btn btn-primary'><span class="iconify" data-icon="bi:eye-fill" data-inline="false"></span></a>
                        <a href="{{ route('competencies.edit', [$competency->id]) }}" class='btn btn-warning'><span class="iconify" data-icon="bx:bx-edit" data-inline="false"></span></a>
                        {!! Form::button('<span class="iconify" data-icon="bi:trash" data-inline="false"></span>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>