<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kode</th>
            <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($competencies as $data)
            <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->code }}</td>
            <td>{{ $data->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
