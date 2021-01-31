<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Perusahaan</th>
                <th>Grup Kompetensi</th>
                <th>Deskripsi</th>
                <th>Action</th>
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
                    <a href="{{ route('competencyGroups.show', [$competencyGroup->id]) }}" class='btn btn-primary' id="detail"><span class="iconify" data-icon="bi:eye-fill" data-inline="false"></span></a>
                        <a href="{{ route('competencyGroups.edit', [$competencyGroup->id]) }}" class='btn btn-warning' id="edit"><span class="iconify" data-icon="bx:bx-edit" data-inline="false"></span></a>
                        {!! Form::button('<span class="iconify" data-icon="bi:trash" data-inline="false"></span>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
