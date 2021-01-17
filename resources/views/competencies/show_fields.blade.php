<div>

<h2> Detail Kompetensi / {{ $competency->name }} ({{ $competency->code }})</h2>
<p>{{ $competency->description }}. Kompetensi {{ $competency->name }} adalah tipe <b>{{ $competency->type }}</b>
yang termasuk kedalam grup <b>{{ $competency->competencyGroup['name'] }}</b></p>
</div>
<br>
<h3>
<img src="https://icon-library.com/images/notepad-icon-png/notepad-icon-png-27.jpg" width="30" height="30" class="d-inline-block align-top"
class="user-image" alt="User Image"/>
<span class="hidden-xs" style="margin-left: 5px">Job Target</span> </h3>
{{ $job->job_name }} 

<br><br>
<h3>
<img src="https://www.materialui.co/materialIcons/communication/vpn_key_black_192x192.png" width="30" height="30" class="d-inline-block align-top" 
class="user-image" alt="User Image"/>
<span class="hidden-xs" style="margin-left: 5px">Key Behaviour</span> <span><a class="btn btn-success" style="margin-left: 5px" href="{{ route('keyBehaviours.create') }}">Add New</a></span></h3>
@include('competencies.behaviour')                           

<h3> Pertanyaan Assessment </h3>
<p>{{ $competency->question }}</p>

<br>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!} {{ $competency->created_at }} <br>
    {!! Form::label('updated_at', 'Updated At:') !!} {{ $competency->updated_at }}
</div>


