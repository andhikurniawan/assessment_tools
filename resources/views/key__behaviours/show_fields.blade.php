<!-- Level Field -->
<div class="form-group">
    {!! Form::label('level', 'Level:') !!}
    <p>{{ $keyBehaviour->level }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $keyBehaviour->description }}</p>
</div>

<!-- Competency Id Field -->
<div class="form-group">
    {!! Form::label('competency_id', 'Competency Id:') !!}
    <p>{{ $keyBehaviour->competency_id }}</p>
</div>

<!-- Indicator Field -->
<div class="form-group">
    {!! Form::label('indicator', 'Indicator:') !!}
    <p>{{ $keyBehaviour->indicator }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $keyBehaviour->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $keyBehaviour->updated_at }}</p>
</div>

