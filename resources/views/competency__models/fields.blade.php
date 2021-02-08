<!-- Company Field -->
<div class="form-group col-sm-12">
    {!! Form::label('company_id', 'Perusahaan:') !!}
    {!! Form::select('company_id',$company,'', ['class' => 'form-control']) !!}
</div>


<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nama Model Kompetensi:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Deskripsi:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="{{ route('competencyModels.index') }}" class="btn btn-danger">Cancel</a>
</div>

