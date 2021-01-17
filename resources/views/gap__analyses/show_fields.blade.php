<!-- Gap Field -->
<div class="form-group">
    {!! Form::label('gap', 'Gap:') !!}
    <p>{{ $gapAnalysis->gap }}</p>
</div>

<!-- Is Match Field -->
<div class="form-group">
    {!! Form::label('is_match', 'Is Match:') !!}
    <p>{{ $gapAnalysis->is_match }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $gapAnalysis->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $gapAnalysis->updated_at }}</p>
</div>

