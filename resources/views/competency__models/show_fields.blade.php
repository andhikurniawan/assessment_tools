

<h2> Detail Model Kompetensi / {{ $competencyModel->name }}</h2>
<p>{{ $competencyModel->description }}. itu deskripsi</b>

<h3>Daftar Kompetensi</h3>
@include('competency__models.competency')                           


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!} {{ $competencyModel->created_at }} <br>
    {!! Form::label('updated_at', 'Updated At:') !!} {{ $competencyModel->updated_at }}
</div>


