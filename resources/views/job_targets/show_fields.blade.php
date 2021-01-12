<!-- Job Name Field -->
<div class="form-group">
    {!! Form::label('job_name', 'Job Name:') !!}
    <p>{{ $jobTargets->job_name }}</p>
</div>

<!-- Job Code Field -->
<div class="form-group">
    {!! Form::label('job_code', 'Job Code:') !!}
    <p>{{ $jobTargets->job_code }}</p>
</div>

<!-- Number Position Field -->
<div class="form-group">
    {!! Form::label('number_position', 'Number Position:') !!}
    <p>{{ $jobTargets->number_position }}</p>
</div>

<!-- Assessment Session Id Field -->
<div class="form-group">
    {!! Form::label('assessment_session_id', 'Assessment Session Id:') !!}
    <p>{{ $jobTargets->assessment_session_id }}</p>
</div>

<!-- Team Id Field -->
<div class="form-group">
    {!! Form::label('team_id', 'Team Id:') !!}
    <p>{{ $jobTargets->team_id }}</p>
</div>

