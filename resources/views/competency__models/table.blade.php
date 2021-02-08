<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Perusahaan</th>
                <th>Model Kompetensi</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($competencyModels as $competencyModel)
            <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $competencyModel->company["name"] }}</td>
            <td>{{ $competencyModel->name }}</td>
            <td>{{ $competencyModel->description }}</td>
                <td>
                    {!! Form::open(['route' => ['competencyModels.destroy', $competencyModel->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    <a href="{{ route('competencyModels.show', [$competencyModel->id]) }}" class='btn btn-primary' id='detail'><span class="iconify" data-icon="bi:eye-fill" data-inline="false"></span></a>
                        <a href="{{ route('competencyModels.edit', [$competencyModel->id]) }}" class='btn btn-warning' id='edit'><span class="iconify" data-icon="bx:bx-edit" data-inline="false"></span></a>
                        {!! Form::button('<span class="iconify" data-icon="bi:trash" data-inline="false"></span>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
