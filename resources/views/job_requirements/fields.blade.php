<!-- Job Target Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_target_id', 'Job Target Id:') !!}
    {!! Form::number('job_target_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Competency Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('competency_id', 'Competency Id:') !!}
    {!! Form::number('competency_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Skill Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('skill_level', 'Skill Level:') !!}
    {!! Form::number('skill_level', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('jobRequirements.index') }}" class="btn btn-default">Cancel</a>
</div>
