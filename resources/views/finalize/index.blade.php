@extends('main')

@section('title', 'Finalize Assessment')

@section('SesiAssessment', 'active')
@switch(session('permission'))
    @case('user')
        @section('user', 'hidden')            
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
            <h1 class="d-inline h3 text-gray-800">Finalize</h1>
        </div>
    </div>


<!-- Assessment Session  -->
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Assessment Session</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody >
                    <tr class="success">
                        <td style="font-weight: bold;">Name</td>
                        <td>{{ $session->name }}</td>
                    <tr>
                    <tr>
                        <td style="font-weight: bold;">Category</td>
                        <td>{{ $session->category }}</td>
                    <tr>
                    <tr class="success">
                        <td style="font-weight: bold;">Status</td>
                        <td>{{ $session->status }}</td>
                    <tr>
                    <tr>
                        <td style="font-weight: bold;">Start Date</td>
                        <td>{{ $session->start_date }}</td>
                    <tr>
                    <tr class="success">
                        <td style="font-weight: bold;">End Date</td>
                        <td>{{ $session->end_date }}</td>
                    <tr>
                    <tr>
                        <td style="font-weight: bold;">Expired</td>
                        <td>{{ $session->expired }}</td>
                    <tr>
                </tbody>
            </table>
        </div>
            </div>
    
      
<!-- Competency Model  -->
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Competency Model</h6>
        </div>
        <div class="card-body">
            <table class="table text-center" id="tableModel">
                <thead>
                    <tr class="success">    
                        <th>#</th>
                        <th>NAME</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($competency as $key => $comp)
                        <tr class="models">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $comp->name }}</td>
                            <td><button id="{{ $key }}" class="btn btn-sm btn-danger deletes">DELETE</button></td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>
            
            <label>Add Competency Model</label>
            <select id ="model" class="form-control" style="height: 40px; width: 300px; margin-top: 10px;">
                @foreach($models as $model)
                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                @endforeach
            </select>
            <br>
            <button id="addModel" class="btn btn-primary btn-sm" style="width: 70px; height: 35px; font-size: 16px; border-radius: 5px; margin-bottom:10px">Add</button>
                     </div>
                 </div>
           
       
<!-- Mapping Participant  -->
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mapping Participants</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <br>
                <div class="col">
                    <h5 style="margin-bottom: 40px;margin-top:10px">Assesse</h5>
                </div>
                <div class="col" >
                    <a href="{{ route('participant.index') }}"><button style="float: right; margin-left: 20px; " class="btn btn-primary"><i class="fa fa-undo"></i> Re-upload</button></a>
                    <button style="float: right;" id="add" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Assesse</button>                    
                </div>
            </div>
            <table class="table text-center" id="tableParticipant">
                <thead>
                    <tr class="success">
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Assesor</th>     
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>                       
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach($participants as $key => $participant)
                        <tr id="rowAssesse{{ $key }}" class="rowAssesse">
                            <td>{{ $participant["assesse"]["name"] }}</td>
                            <td>{{ $participant["assesse"]["email"] }}</td>
                            <td><span class='badge' style="background-color: #4fd6a2;color:#ffffff">{{ count($participant["assessor"]) }}</span></td>
                            <td><a href="#" class="deleteAssesse" id="0"><i class="fa fa-minus-circle" style="color: red; font-size: 20px;"></i></a></td>
                            <td><a data-toggle="collapse" href="#collapse{{ $key }}"><i class="fa fa-angle-double-down" style="font-size: 20px;"></i></a></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="padding: 0;">
                            <div id="collapse{{ $key }}" class="panel-collapse collapse">
                                <h3><span class='badge' style="margin-top:30px">Assessor List</span><button id="{{ $key }}" class='btn addAssessor' style=" float: right;"><span class='badge' style="background-color: #4fd6a2;color:#ffffff; margin-top:30px">Add Assessor</span></button></h3>
                                <table class="table" style="margin-bottom: 30px;">
                                        <thead>
                                            <tr class="warning">
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Relationship</th>
                                                <th>Status</th>     
                                                <th>&nbsp;</th>                  
                                            </tr>
                                        </thead>
                                        <tbody id="rowAssessor{{ $key }}">
                                            @foreach($participant["assessor"] as $assessor)
                                                <tr class="colAssessor">
                                                    <td>{{ $assessor["name"] }}</td>
                                                    <td>{{ $assessor["email"] }}</td>
                                                    <td>{{ $assessor["relation"] }}</td>
                                                    <td>{{ $assessor["status"]}}</td>
                                                    <td><a href="#" class="deleteAssessor" id="0"><i class="fa fa-minus-circle" style="color: red; font-size: 20px;"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
               
<!-- Button Save Or Close -->
        <br>
        <div class="container" style="margin-top:30px">
            <div class="row" style="margin-left: 40%;">
                <div class="col-sm-1" style="margin-right: 30px;">
                    <button class="btn btn-primary" id="saveAll" style="margin-bottom: 20px;">Save</button>
                </div>
                <div class="col-sm-1">
                    <a href="{!! route('assessmentSessions.index') !!}" class="btn btn-danger" style="margin-bottom: 20px;">Cancel</a>
                </div>
            </div>
        </div>

<!-- Modals Add Participants -->
<div class="modal fade" id="addParticipant" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title text-center">Add Participants</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
            <div class="container-fluid" style="border: 1px solid blackl">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="row">
                    <div class="col-sm-6">
                        <label>IdUser Assesse</label>
                        <select class="form-control" name="assesse" id="assesse">
                        @foreach($id as $ids)
                            <option value="{{ $ids->employee_id }}">{{ $ids->employee_id }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Relation</label>
                        <select class="form-control" name="relation" id="relation">
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
                        <select class="form-control" name="assessor" id="assessor">
                        @foreach($id as $ids)
                            <option value="{{ $ids->employee_id }}">{{ $ids->employee_id }}</option>
                        @endforeach
                        </select>   
                    </div>
                    <div class="col-sm-6">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Yet to started">Yet to started</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="save">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addAssessor" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title text-center">Add Assessor</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
            <div class="container-fluid" style="border: 1px solid blackl">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" id="row_id">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Relation</label>
                        <select class="form-control" name="relation" id="relation1">
                            <option value="Peer">Peer</option>
                            <option value="Self">Self</option>
                            <option value="Subordinate">Subordinate</option>
                            <option value="Supervisor">Supervisor</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status1">
                            <option value="Yet to started">Yet to started</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <label>IdUser Assessor</label>
                        <select class="form-control" name="assessor" id="assessor1">
                        @foreach($id as $ids)
                            <option value="{{ $ids->employee_id }}">{{ $ids->employee_id }}</option>
                        @endforeach
                        </select>   
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <button type="button" class="btn btn-primary" id="saveAssessor">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">

    $(document).ready(function(){

        var assessmentSession = {!! json_encode($session) !!};
        var competencyModel = {!! json_encode($competency) !!};
        var dataParticipant = {!! json_encode($participants) !!}

        $("#addModel").on("click", function(){

            var model = $("#model option:selected").text();
            var count = document.getElementsByClassName("models");

            var compModel = {
                id : $("#model").val(),
                name : model,
            }

            competencyModel.push(compModel);

            $("#tableModel").find("tbody").append("<tr class='models'><td>" + (count.length + 1) + "</td><td>" + model + "</td><td><button id='" + (count.length + 1) + "' class='btn btn-danger deletes'>Delete</td></tr>");
        });     

        $(document).on("click", "button.deletes", function(){

            var index = $(this).closest("tr").index();

            $(this).closest("tr").remove();

            competencyModel.splice(index, 1);
        });

        $("#add").on("click", function(){

            $("#addParticipant").modal("toggle");

        });

        $(document).on("click", "button.addAssessor", function(){

            $("#addAssessor").modal("toggle");

            $("#row_id").val(this.id);

        });

        $(document).on("click", "a.deleteAssesse", function(){

        for(var i = 0; i < dataParticipant.length; i++)
        {
            if(dataParticipant[i].id == this.id)
            {
                dataParticipant.splice(i, 1);
            }
        }

        var index = $(this).closest("tr").index();

        var tr = document.getElementById("tbody").deleteRow(index);
        var tr = document.getElementById("tbody").deleteRow(index);
        });

        $(document).on("click", "a.deleteAssessor", function(){

        var index = $(this).closest("tr").index();

        var id = this.id;

        alert(JSON.stringify(dataParticipant[id].assessor));

        dataParticipant[id].assessor.splice(index, 1);

        alert(JSON.stringify(dataParticipant[id].assessor));

        var tr = document.getElementById("rowAssessor" + id);

        $(this).closest("tr").remove();

        var td = $("#rowAssesse" + id).find("td");

        var count = $("#rowAssessor" + id).find($(".colAssessor")).length;

        td.find("span").html(count); 

        // dataParticipant.splice(this.id, 1);
        // var tr = document.getElementById("tbody").deleteRow(index);
        // var tr = document.getElementById("tbody").deleteRow(index);
        });

        $("#save").on("click", function(){

            var assesse = $("#assesse").val();
            var assessor = $("#assessor").val();
            var status = $("#status").val();
            var relationship = $("#relation").val();

            var tr = $(".rowAssesse").length;

            var html = "<tr id='rowAssesse" + tr + "' class='rowAssesse'>";

            $.ajax({
                url: "{{ route('participant.cari') }}",
                method: "GET",
                data: {
                    assesse: assesse,
                    assessor: assessor
                },
                success: function(data){

                    html = html.concat("<td>" + data["assesse"].nama + "</td><td>" + data["assesse"].email + "</td><td><span class='badge' style='background-color: #4fd6a2;'>1</span></td>");
                    html = html.concat('<td><a href="#" class="deleteAssesse" id="' + tr + '"><i class="fa fa-minus-circle" style="color: red; font-size: 20px;"></i></a></td>');
                    html = html.concat('<td><a data-toggle="collapse" href="#collapse' + tr  +'"><i class="fa fa-angle-double-down" style="font-size: 20px;"></i></a></td></tr>');
                    html = html.concat('<td colspan="3" style="padding: 0;"><div id="collapse' + tr + '" class="panel-collapse collapse">');
                    html = html.concat('<h3><span class="badge" >Assessor List</span><button id="' + tr  + '" class="btn addAssessor" style="float: right;"><span class="badge" style="background-color: #4fd6a2;">Add Accessor</span></button></h3>');
                    html = html.concat('<table class="table" style="margin-bottom: 30px;">');
                    html = html.concat('<thead><tr class="warning"><th>Name</th><th>Email</th><th>Relationship</th><th>Status</th></tr></thead>');
                    html = html.concat('<tbody id="rowAssessor' + tr + '"><tr class="colAssessor"><td>' + data["assessor"].name +'</td><td>' + data["assessor"].email +'</td><td>' + relationship +'</td><td>' + status +'</td></tr></tbody></table></div></td></tr>');

                    var assessor1 = {
                        name: data["assessor"].name,
                        email: data["assessor"].email
                    }

                    var detail = {
                        id: tr,
                        assesse : data["assesse"],
                        assessor : [],
                        relation : relationship,
                        status : status
                    }

                    detail.assessor.push(assessor1);

                    dataParticipant.push(detail);

                    $(".table").find("#tbody").append(html);   
                }
            })
        }); 

        $("#saveAssessor").on("click", function(){

            var tr = $(".rowAssesse");

            var assessor = $("#assessor1").val();
            var status = $("#status1").val();
            var relationship = $("#relation1").val();

            $.ajax({
                url: "{{ route('participant.cari') }}",
                method: "GET",
                data: {
                    assesse: "",
                    assessor: assessor
                },
                success: function(data){

                    alert($("#row_id").val());

                    var html = '<tr class="colAssessor"><td>' + data["assessor"].name +'</td><td>' + data["assessor"].email +'</td><td>' + relationship +'</td><td>' + status +'</td></tr>';

                    $(".table").find("#rowAssessor" + $("#row_id").val()).append(html);

                    var td = $("#rowAssesse" + $("#row_id").val()).find("td");

                    var count = $("#rowAssessor" + $("#row_id").val()).find($(".colAssessor")).length;

                    td.find("span").html(count); 

                    $("#addAssessor").modal("hide");

                    var assessor1 = {
                        name: data["assessor"].name,
                        email: data["assessor"].email
                    }

                    dataParticipant[$("#row_id").val()].assessor.push(assessor1);
                }
            })
        });

        function setHeader(data){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': data
                }
            });
        }
        
        setHeader($('meta[name="csrf-token"]').attr('content'));

        $("#saveAll").on("click", function(){

            $.ajax({
                url: "{{ route('finalize.finalize') }}",
                method: "POST",
                data: {
                    session: assessmentSession,
                    model: competencyModel,
                    participant: dataParticipant,
                },
                success: function(data)
                {
                    if(data == "0")
                    {
                        swal({
                            className: "swal-back",
                            title: "Berhasil",
                            text: "Berhasil Menambah Assessment Session", 
                            icon: "success"
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location.href = "{{ url('/assessment') }}";
                            } 
                        });
                        
                    }
                }
            })


        });
        
    }); 


</script>

@endsection