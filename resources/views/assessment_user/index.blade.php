@extends('layouts.app')

@section('content')
<section class="content-header" >
        <h1 class="pull-left" style="margin-top: 10px; margin-bottom: 35px; margin-left:10px;">Welcome, {{ Auth::user()->name }} !</h1>
    </section>
<div class="content">
    <div class="container-fluid">

 <div class="row" style="margin-bottom: 10px; margin-left:0px; margin-top: 50px;" >
    <div class="col-lg">
     <h4>All Session</h4>
    </div>
</div>
        

        
        <form method="post" action="{{ route('assessmentUser.detail') }}" id="formsubmit">
        <input type="hidden" value="" id="session_id" name="id">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
       
        <div class="box box-primary">
            <div class="box-body">
            <div class="table-responsive" style="margin-top:10px">
        <table class="table text-center table-striped" id="table_id">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>PARTICIPANTS</th>
                    <th>STATUS</th>
                    <th>START DATE</th>
                    <th>END DATE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>       
                @foreach($assessments as $assessment)
                    <tr>
                        <td>{{ $assessment->name }}</td>
                        <td>{{ $assessment->counts }}</td>
                        <td>{{ $assessment->status }}</td>
                        <td>{{ $assessment->start_date }}</td>
                        <td>{{ $assessment->end_date }}</td>   
                        <td> <button id="{{ $assessment->id }}" class="btn btn-xs btnsubmit"><i class="glyphicon glyphicon-eye-open"></i></button>  </td>
                      
                    </tr>
                @endforeach
                
            </tbody>
        </table>    
        </form>
                     </div>
                 </div>
           
           </div>

        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">

$(document).ready(function(){

    $('#table_id').DataTable();

    $(document).on("click", "button.btnsubmit" , function() {

        document.getElementById("session_id").value = this.id;

        alert($("#session_id").val());

        // $("#formsubmit").submit();

    });


});

</script>

@endsection