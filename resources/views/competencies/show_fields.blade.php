<div>
<br>
<h2> Detail Kompetensi / {{ $competency->name }} ({{ $competency->code }})</h2>
<p>{{ $competency->description }}. Kompetensi {{ $competency->name }} termasuk 
kedalam <b>{{ $competency->jenis }} competency</b> dengan tipe <b>{{ $competency->type }}</b>
dan termasuk kedalam grup <b>{{ $competency->competencyGroup['name'] }}.</b></p>
</div>
<hr><br>
<h4><b>Job Target</b></h4>
@foreach($req as $j)
{{ $j->job }}, 
@endforeach
<hr><br>

<h4> <b>Pertanyaan Assessment </b></h4>
<p>{{ $competency->question }}</p>

<hr><br>
<h4>
<img src="https://www.materialui.co/materialIcons/communication/vpn_key_black_192x192.png" width="24" height="24" class="d-inline-block align-top" 
class="user-image" alt="User Image"/>
<span class="hidden-xs" style="margin-left: 5px"><b>Key Behaviour</b></span> </h4>
@include('competencies.behaviour')    
                  


<br>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!} {{ $competency->created_at }} <br>
    {!! Form::label('updated_at', 'Updated At:') !!} {{ $competency->updated_at }}
</div>


@section('script')
 <!-- Page level plugins -->
 <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>

    @endsection
