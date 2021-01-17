
<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nama Model Kompetensi:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Deskripsi:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Company Field -->
<div class="form-group col-sm-12">
    {!! Form::label('company_id', 'Perusahaan:') !!}
    {!! Form::select('company_id',$companies,'', ['class' => 'form-control']) !!}
</div>

<!-- Competency Field -->
<div class="form-group col-sm-12">
    {!! Form::label('competency_id', 'Kompetensi:') !!}
    {!! Form::select('competency_id',$competencies,'', ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="{{ route('competencyModels.index') }}" class="btn btn-danger">Cancel</a>
</div>
