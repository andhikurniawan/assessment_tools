<div class="table-responsive">
    <table class="table" id="jobRequirements-table">
        <thead>
            <tr>
                <th>Job Target Id</th>
        <th>Competency Id</th>
        <th>Skill Level</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($jobRequirements as $jobRequirement)
            <tr>
                <td>{{ $jobRequirement->job_target_id }}</td>
            <td>{{ $jobRequirement->competency_id }}</td>
            <td>{{ $jobRequirement->skill_level }}</td>
                <td>
                    {!! Form::open(['route' => ['jobRequirements.destroy', $jobRequirement->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('jobRequirements.show', [$jobRequirement->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('jobRequirements.edit', [$jobRequirement->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
