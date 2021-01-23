

<h4> Detail Model Kompetensi / {{ $competencyModel->name }}</h4>
<p>{{ $competencyModel->description }}.</p>
<br>

<h5>Daftar Kompetensi</h5>
@include('competency__models.competency')                           

<br>
<!-- Created At Field -->
<div class="form-group">
   {!! Form::label('created_at', 'Created At:') !!} {{ $competencyModel->created_at }} <br>
    {!! Form::label('updated_at', 'Updated At:') !!} {{ $competencyModel->updated_at }}
</div>


