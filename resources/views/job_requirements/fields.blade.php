<!-- Job Target Id Field -->
{!! Form::hidden('job_target_id', $job_target_id, ['class' => 'form-control']) !!}

<!-- Competency Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('competency_id', 'Competency Id:') !!}
    {!! Form::select('competency_id', $items, null, ['class' => array('form-control','select2-single')]) !!}
</div>

<!-- Skill Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('skill_level', 'Skill Level:') !!}
    {!! Form::number('skill_level', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('jobRequirements.index', ['job_target_id'=>$job_target_id]) !!}" class="btn btn-default">Cancel</a>
</div>
