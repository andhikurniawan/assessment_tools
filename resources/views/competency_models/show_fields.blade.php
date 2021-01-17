<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $competencyModels->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $competencyModels->description }}</p>
</div>

<!-- Company Id Field -->
<div class="form-group">
    {!! Form::label('company_id', 'Company Id:') !!}
    <p>{{ $competencyModels->company_id }}</p>
</div>

<!-- Competency Id Field -->
<div class="form-group">
    {!! Form::label('competency_id', 'Competency Id:') !!}
    <p>{{ $competencyModels->competency_id }}</p>
</div>

