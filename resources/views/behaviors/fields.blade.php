<!-- Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::text('level', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Indicator Field -->
<div class="form-group col-sm-6">
    {!! Form::label('indicator', 'Indicator:') !!}
    {!! Form::text('indicator', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('behaviors.index') }}" class="btn btn-default">Cancel</a>
</div>
