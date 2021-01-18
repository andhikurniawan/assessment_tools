<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Pegawai</th>
                <th>Job Target</th>
                <th>Job Requirement</th>
                <th>Hasil Assessment</th>
                <th>Gap</th>
                <th>Match</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($gapAnalyses as $gapAnalysis)
            <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $gapAnalysis->gap }}</td>
            <td>{{ $gapAnalysis->is_match }}</td>
            <td>{{ $gapAnalysis->gap }}</td>
            <td>{{ $gapAnalysis->is_match }}</td>
            <td>{{ $gapAnalysis->gap }}</td>
            <td>{{ $gapAnalysis->is_match }}</td>
                <td>
                    {!! Form::open(['route' => ['gapAnalyses.destroy', $gapAnalysis->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {!! Form::button('<span class="iconify" data-icon="bi:trash" data-inline="false"></span>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
