<!-- Level Field -->
<div class="form-group col-sm-6">
{!! Form::label('level', 'Level:') !!}  
{!! Form::select('level', $levels,null, ['class' => 'form-control']) !!}
</div>



<!-- Competency Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('competency_id', 'Competency Id:') !!}
    {!! Form::number('competency_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Indicator Field -->
<div class="form-group col-sm-6">
    {!! Form::label('indicator', 'Indicator:') !!}
    {!! Form::textarea('indicator', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="{{ route('keyBehaviours.index') }}" class="btn btn-default">Cancel</a>
</div>
