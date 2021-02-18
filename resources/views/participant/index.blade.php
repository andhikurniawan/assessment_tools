@extends('main')

@section('title', 'Mapping Participants')

@section('SesiAssessment', 'active')
@switch(session('permission'))
    @case('user')
        @section('user', 'hidden')
        @section('superadmin', 'hidden')            
        @section('admin', 'hidden')            
        @section('admin_pm', 'hidden')            
        @section('admin_ot', 'hidden')                   
        @break
    @case('admin_tnd')
        @section('superadmin', 'hidden')            
        @section('admin', 'hidden')            
        @section('admin_pm', 'hidden')            
        @section('admin_ap', 'hidden')            
        @section('admin_ot', 'hidden')            
        @break
        @case('admin_ap')
    @section('superadmin', 'hidden')            
    @section('admin', 'hidden')            
    @section('admin_pm', 'hidden')            
    @section('admin_tnd', 'hidden')            
    @section('admin_ot', 'hidden')  
    @break
    @case('admin')
        @section('superadmin', 'hidden')                
            @break
    @default

@endswitch
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <h1 class="d-inline h3 text-gray-800">Mapping Participants</h1>
        </div>
    </div>

   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Build Upload Participants</h6>
        </div>
        <div class="card-body">
        <div class="row mt-4">
            <div class="col text-center">
            
                <label>1. Download Excel Template</label>
               
                <a href="/file/template_participants_2.xlsx" download="template_participants.xlsx" id="download" style="text-decoration: none;">
                    <div class="text-center" style="width: 230px; height: 250px; border: 1px dashed blue; margin: 0 auto;">
                        <label style="margin-top: 40%; font-size: 18px; color: black;">Download Template</label>
                        <label style="font-size: 10px; color: black;">Click here to download template</label>
                    </div>
                </a>
            </div>
            <div class="col text-center">
              
             <label>2. Upload Excel Template</label>
              
                <div class="text-center" id="dragdrop" style="width: 230px; height: 250px; border: 1px dashed blue; margin: 0 auto;">
                    <form id="participantUpload" style="width: 100%; height: 100%;" method="post" action="{{ route('participant.detail') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="method" value="Upload">
                        <input type="file" id="fileInput" name="file" style="width: 100%; height: 100%; margin-top: 40%; margin-left:5%" class="text-center">
                    </form>
                </div>
            </div>
        </div>
        <br><br>
        <div class="text-center" >
            <label>OR</label>
        </div>
        <br>
        <div class="text-center" style="margin-bottom:20px">
            <button id="add" class="btn btn-primary center-block">Add Participants Through Interface</button>
        </div>
       
        </div>
    </div>

    
           
    
<div class="modal fade" id="addParticipant" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title text-center">Add Participants</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body"> 
            <div class="container-fluid" style="border: 1px solid blackl">
                <form method="post" action="{{ route('participant.detail') }}" id="form">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="method" value="Manual">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>IdUser Assesse</label>
                            <select class="form-control" name="assesse">
                            @foreach($id as $ids)
                                <option value="{{ $ids->employee_id }}">{{ $ids->employee_id }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Relation</label>
                            <select class="form-control" name="relation">
                                <option value="Peer">Peer</option>
                                <option value="Self">Self</option>
                                <option value="Subordinate">Subordinate</option>
                                <option value="Supervisor">Supervisor</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>IdUser Assessor</label>
                            <select class="form-control" name="assessor">
                            @foreach($id as $ids)
                                <option value="{{ $ids->employee_id }}">{{ $ids->employee_id }}</option>
                            @endforeach
                            </select>   
                        </div>
                        <div class="col-sm-6">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="Yet to started">Yet to start</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="save" data-dismiss="modal">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>


<script type="text/javascript">

    var file;

    $(document).ready(function() {

        $("#download").on("click", function(){
            alert("downloading");
        }); 

        $("#add").on("click", function(){
            $("#addParticipant").modal("toggle");
        });

        $("#save").on("click", function(){
            $("#form").submit();
        });


    });

    $("#participantUpload").change(function(){

        setTimeout(function(){
            var txt = "";

            if (confirm("Upload file?")) 
            {   
                $("#participantUpload").submit();
            } 
        }, 200)
        

    });

    // function dropHandler(ev) {
    //     console.log('File(s) dropped');

    //     ev.preventDefault();

    //     if (ev.dataTransfer.items) {
           
    //         for (var i = 0; i < ev.dataTransfer.items.length; i++) {
            
    //             if (ev.dataTransfer.items[i].kind === 'file') 
    //             {
    //                 file = ev.dataTransfer.items[i].getAsFile();
                    
    //                 $("#filename").html(file.name); 

    //                 setTimeout(function(){

    //                     var txt = "";

    //                     if (confirm("Upload file?")) 
    //                     {   
    //                         $("#participantUpload").submit();
    //                     } 
    //                 }, 200)
    //             }
    //         }

            
    //     } 
    //     else {
    //         // Use DataTransfer interface to access the file(s)
    //         for (var i = 0; i < ev.dataTransfer.files.length; i++) {
    //         console.log('... file[' + i + '].name = ' + ev.dataTransfer.files[i].name);
    //         }
    //     }
    // }

    // function dragOverHandler(ev) {
    //     console.log('File(s) in drop zone'); 
    

    //     // Prevent default behavior (Prevent file from being opened)
    //     ev.preventDefault();
    // }

</script>
@endsection