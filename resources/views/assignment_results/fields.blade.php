<!-- Employee Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    {!! Form::text('employee_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Jobcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jobcode', 'Jobcode:') !!}
    {!! Form::text('jobcode', null, ['class' => 'form-control']) !!}
</div>

<!-- Header Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('header_id', 'Header Id:') !!}
    {!! Form::text('header_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Gap Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gap', 'Gap:') !!}
    {!! Form::number('gap', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('assignmentResults.index') !!}" class="btn btn-default">Cancel</a>
</div>
