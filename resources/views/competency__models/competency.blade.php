<div class="table-responsive">
    <table class="table" id="competencies-table">
        <thead>
            <tr>
            <th>Nama</th>
            <th>Kode</th>
            <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($competencyRelation as $data)
            <tr>
            <td>{{ $data->competency->name }}</td>
            <td>{{ $data->competency->code }}</td>
            <td>{{ $data->competency->indicator }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
