<!-- Level Field -->
<div class="form-group">
    {!! Form::label('level', 'Level:') !!}
    <p>{{ $behavior->level }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $behavior->description }}</p>
</div>

<!-- Indicator Field -->
<div class="form-group">
    {!! Form::label('indicator', 'Indicator:') !!}
    <p>{{ $behavior->indicator }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $behavior->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $behavior->updated_at }}</p>
</div>

