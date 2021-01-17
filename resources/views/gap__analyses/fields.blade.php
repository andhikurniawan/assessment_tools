<!-- Gap Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gap', 'Gap:') !!}
    {!! Form::text('gap', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Match Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_match', 'Is Match:') !!}
    {!! Form::text('is_match', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('gapAnalyses.index') }}" class="btn btn-default">Cancel</a>
</div>
