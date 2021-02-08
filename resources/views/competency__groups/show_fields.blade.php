<h3> Detail Grup Kompetensi / {{ $competencyGroup->name }}</h3>
<p>{{ $competencyGroup->description }}.</p>
<br>

<h5><b>Daftar Kompetensi</b></h5>
@include('competency__groups.competency')                           


<br>
<!-- Created At Field -->
<div class="form-group">
   {!! Form::label('created_at', 'Created At:') !!} {{ $competencyGroup->created_at }} <br>
    {!! Form::label('updated_at', 'Updated At:') !!} {{ $competencyGroup->updated_at }}
</div>


@section('script')
 <!-- Page level plugins -->
 <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>

    @endsection

