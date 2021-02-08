<!-- Assessment Session Id Field -->
<div class="form-group">
    {!! Form::hidden('assessment_session_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::hidden('team_id', 1, ['class' => 'form-control']) !!}
</div>

<!-- Job Name Field -->
<div class="form-group">
    {!! Form::label('job_name', 'Job Name:') !!}
    {!! Form::text('job_name', null, ['class' => 'form-control','maxlength' => 256,'maxlength' => 256]) !!}
</div>

<!-- Job Code Field -->
<div class="form-group">
    {!! Form::label('job_code', 'Job Code:') !!}
    {!! Form::text('job_code', null, ['class' => 'form-control','maxlength' => 32,'maxlength' => 32]) !!}
</div>

<!-- Number Position Field -->
<div class="form-group">
    {!! Form::label('number_position', 'Number Position:') !!}
    {!! Form::number('number_position', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('jobTargets.index') }}" class="btn btn-default">Cancel</a>
</div>
