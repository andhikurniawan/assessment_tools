<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Kode:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Tipe Kompetensi:') !!}
    {!! Form::select('type', array('Softskill' => 'Soft Skill', 'Hardskill' => 'Hard Skill'), null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nama Kompetensi:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<!-- Perusahaan Field -->
<div class="form-group col-sm-6">
{!! Form::label('competency_group_id', 'Grup Kompetensi:') !!}  
{!! Form::select('competency_group_id',$competencyGroup,'', ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Deskripsi:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Pertanyaan:') !!}
    {!! Form::textarea('question', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="{{ route('competencies.index') }}" class="btn btn-default">Cancel</a>
</div>
