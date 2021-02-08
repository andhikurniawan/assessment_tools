<!-- Id Field -->
<div class="form-group">
    <p>#{!! $assignmentHeader->id !!}  {!! (empty($assignmentHeader->assessmentSession)?'-':$assignmentHeader->assessmentSession->name) !!}</p>
</div>

<!-- Run Counter Field -->
<div class="form-group">
    {!! Form::label('run_counter', 'Run Counter:') !!}
    {!! $assignmentHeader->run_counter !!}
</div>

<!-- Run Date Field -->
<div class="form-group">
    {!! Form::label('run_date', 'Run Date:') !!}
     {!! $assignmentHeader->run_date !!} 
</div>

<!-- Is Effective Field -->
<div class="form-group">
    {!! Form::label('is_effective', 'Is Effective:') !!}
    {!! $assignmentHeader->is_effective !!}
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! $assignmentHeader->created_at !!}
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    {!! $assignmentHeader->updated_at !!}
</div>

