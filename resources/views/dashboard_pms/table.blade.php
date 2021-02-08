<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Grup Kompetensi</th>
            <th>Nama</th>
            <th>Tipe</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($competencies as $competency)
            <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $competency->code }}</td>
            <td>{{ $competency->competencyGroup->name }}</td>
            <td width="100">{{ $competency->name }}</td>
            <td>{{ $competency->type }}</td>
            <td>{{ $competency->status }}</td>
                    <td>
                      <div class='btn-group'>
                        <a href="{{ route('competencies.show', [$competency->id]) }}" class='btn btn-primary'>Detail</a>
                             </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
