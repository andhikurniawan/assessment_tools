<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Team</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Assessment Session Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td>{{ $team->name }}</td>
                            <td>{!! $team->assessmentSession->name !!}</td>
                            <td>
                                {!! Form::open(['route' => ['teams.destroy', $team->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="" class='btn btn-success btn-xs'><span class="iconify" data-icon="ant-design:copy-outlined" data-inline="false"></span></a>
                                    <a href="{{ route('teams.show', [$team->id]) }}" class='btn btn-success btn-xs'><span class="iconify" data-icon="bx:bx-show" data-inline="false"></span></a>
                                    <a href="{{ route('teams.edit', [$team->id]) }}" class='btn btn-secondary btn-xs'><span class="iconify" data-icon="ant-design:edit-outlined" data-inline="false"></span></a>
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