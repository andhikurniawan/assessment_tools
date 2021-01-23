

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


@section('script')
 <!-- Page level plugins -->
 <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>

    @endsection
