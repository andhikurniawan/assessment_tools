<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Assessment Session Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assessment_session_id', 'Assessment Session Id:') !!}
    {!! Form::select('assessment_session_id', $sessions, null, ['class' => 'form-control', 'placeholder' => '- Select Assessment Session -']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('jobTargets.index') }}" class="btn btn-default">Cancel</a>
</div>
