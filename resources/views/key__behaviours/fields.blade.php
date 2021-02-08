<!-- Competency Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('competency_id', 'Kompetensi:') !!}
    {!! Form::select('competency_id',$competencies,'', ['class' => 'form-control']) !!}
</div>

<!-- Level Field -->
<div class="form-group col-sm-12">
{!! Form::label('level', 'Level:') !!}  
{!! Form::select('level', $levels,null, ['class' => 'form-control']) !!}
</div>


<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="/competencies" class="btn btn-default">Cancel</a>
</div>
