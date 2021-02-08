<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Competency Id</th>
                    <th>Skill Level</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($jobRequirements as $jobRequirement)
                    <tr>
                        <td>{{ $jobRequirement->Competency->code }}</td>
                        <td>{{ $jobRequirement->skill_level }}</td>
                        <td>
                            {!! Form::open(['route' => ['jobRequirements.destroy', $jobRequirement->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{{ route('jobRequirements.show', [$jobRequirement->id]) }}" class='btn btn-success btn-xs'><span class="iconify" data-icon="bx:bx-show" data-inline="false"></span></a>
                                <a href="{{ route('jobRequirements.edit', [$jobRequirement->id]) }}" class='btn btn-secondary btn-xs'><span class="iconify" data-icon="ant-design:edit-outlined" data-inline="false"></span></a>
                                {!! Form::button('<span class="iconify" data-icon="ant-design:delete-outlined" data-inline="false"></span>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>