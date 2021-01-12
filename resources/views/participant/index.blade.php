@extends('layouts.app')

@section('content')
<section class="content-header" >
        <h1 style="margin-top:20px">
           Mapping Participants
        </h1>
    </section>

    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">

    <div class="container" style="margin-top:10px">
        <div class="row">
            <b><h4 class="text-center">Build Upload Participants</h4></b>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6 text-center">
                <div class="row">
                    <label>1. Download Excel Template</label>
                </div>
                <br>
                <a href="/file/template_participants_fix.xlsx" download="template_participants.xlsx" id="download" style="text-decoration: none;">
                    <div class="row" style="width: 200px; height: 250px; border: 1px dashed black; margin: 0 auto;">
                        <label style="margin-top: 50%; font-size: 18px; color: black;">Download Template</label>
                        <label style="font-size: 10px; color: black;">Click here to download template</label>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 text-center">
                <div class="row">
                    <label>2. Upload Excel Template</label>
                </div>
                <br>
                <div class="row" id="dragdrop" style="width: 200px; height: 250px; border: 1px dashed black; margin: 0 auto;">
                    <form id="participantUpload" style="width: 100%; height: 100%;" method="post" action="{{ route('participant.detail') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="method" value="Upload">
                        <input type="file" id="fileInput" name="file" style="width: 100%; height: 100%; margin-top: 50%; margin-left:5%" class="text-center">
                    </form>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row text-center" >
            <label>OR</label>
        </div>
        <br>
        <div class="row center-block" style="margin-bottom:20px">
            <button id="add" class="btn btn-primary center-block">Add Participants Through Interface</button>
        </div>
    </div>

    
                </div>
            </div>
        </div>
    </div>

    
<div class="modal fade" id="addParticipant" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Add Participants</h4>
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