<!-- Assessment Session -->
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Assessment Session</h6>
        </div>
        <div class="card-body">
<!-- Name Field -->
<div class="row">
<div class="form-group col-sm-6">
    <label>Name : </label>
    <input id="name" type="text" name="name" value="{{ $assessmentSession->name }}" class="form-control">
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    <label>Category : </label>
    <select id="category" value="{{ $assessmentSession->category }}" class="form-control" name="category">
        <option value="development">development</option>
        <option value="management">management</option>
        <option value="project manager">project manager</option>
    </select>
</div>
</div>

<!-- Status Field -->
<div class="row">
<div class="form-group col-sm-6">
    <label>Status : </label>
    <select id="statusOriginal" value="{{ $assessmentSession->status}}" class="form-control" name="status">
        <option value="open">open</option>
        <option value="finished">finished</option>
        <option value="not_started">not_started</option>
    </select>
</div>

<!-- Expired Field -->
<div class="form-group col-sm-6">
    <label>Expired : </label>
    <select id="expired" value="{{ $assessmentSession->expired }}" class="form-control" name="expired">
        <option value="one year">one year</option>
        <option value="three month">three month</option>
        <option value="six month">six month</option>
    </select>
</div>
</div>

<!-- Start Date Field -->
<div class="row">
<div class="form-group col-sm-6">
    <label>Start Date : </label>
    <input id="start_date" class="form-control" value="{{ $assessmentSession->start_date }}" id="start_date" name="start_date" type="date">
</div>

<!-- End Date Field -->
<div class="form-group col-sm-6">
    <label>End Date : </label>
    <input id="end_date" class="form-control" value="{{ $assessmentSession->end_date }}" id="end_date" name="end_date" type="date">
</div>
    </div>
</div>
</div>


<!-- Competency Model -->
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Competency Model</h6>
        </div>
        <div class="card-body">
<div class="form-group col-sm-12">
    <table class="table text-center" id="tableModel">
        <thead>
            <tr>    
                <th>#</th>
                <th>NAME</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($models as $key => $model)
                <tr class="models">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $model->name }}</td>
                    <td><a class="btn btn-sm btn-danger deletes" data="original" id="{{ $model->competency_models_id }}">Delete</a></td>
                </tr>   
            @endforeach
        </tbody>
    </table>
    <label>Add Competency Model</label>
    <select id ="model" name="model" class="form-control" style="height: 40px; width: 300px; margin-top: 10px;">
        @foreach($modelss as $model)
            <option value="{{ $model->id }}">{{ $model->name }}</option>
        @endforeach
    </select>
    <br><br>
    <a id="addModel" class="btn btn-primary btn-sm" style="width: 65px; height: 35px; font-size: 16px; border-radius: 5px;">Add</a>
</div>
</div>
</div>

<!-- Participants -->
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Participants</h6>
        </div>
        <div class="card-body">
<div class="form-group col-sm-12">
    <div class="row">
        <br>
        <div class="col-sm-4">
            <label style="margin-bottom: 40px;">Assesse</label>
        </div>
        <div class="col-sm-8" >
            <a style="float: right;" id="add" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Assesse</a>                    
        </div>
    </div>
    <table class="table text-center" id="tableParticipant">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Assesor</th>     
                <th>&nbsp;</th>  
                <th>&nbsp;</th>                      
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach($participants as $key => $participant)
                <tr id="rowAssesse{{ $key }}" class="rowAssesse row_tbody">
                    <td>{{ $participant->name }}</td>
                    <td>{{ $participant->email }}</td>
                    <td><span class='badge' style="background-color: #4fd6a2;color:#ffffff">{{ count($participant->assessor) }}</span></td>
                    <td><a href="#" data="original" class="deleteAssesse" id="{{ $key }}"><i class="fa fa-minus-circle" style="color: red; font-size: 20px;"></i></a></td>
                    <td><a data-toggle="collapse" class="detail" href="#collapse{{ $key }}"><i class="fa fa-angle-double-down" style="font-size: 20px;"></i></a></td>
                </tr>
                <tr class="row_tbody">
                    <td colspan="3" style="padding: 0;">
                    <div id="collapse{{ $key }}" class="panel-collapse collapse">
                        <h3><span class='badge' style="margin-top:30px;" >Assessor List</span><button id="{{ $key }}" class='btn addAssessor' style=" float: right;"><span class='badge' style="background-color: #4fd6a2;color:#ffffff; margin-top:30px;">Add Assessor</span></button></h3>
                        <table class="table" style="margin-bottom: 40px;">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Relationship</th>
                                        <th>Status</th>
                                        <th>&nbsp;</th>                          
                                    </tr>
                                </thead>
                                <tbody id="rowAssessor{{ $key }}">
                                    @foreach($participant->assessor as $assessor)
                                        <tr class="colAssessor">
                                            <td>{{ $assessor->name }}</td>
                                            <td>{{ $assessor->email }}</td>
                                            <td>{{ $assessor->relation }}</td>
                                            <td>{{ $assessor->status }}</td>
                                            <td><a href="#" data="original" class="deleteAssessor" id="{{ $key }}"><i class="fa fa-minus-circle" style="color: red; font-size: 20px;"></i></a></td>
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
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12" style="margin-left: 40%;margin-top:70px">
    <a class="btn btn-primary mt-4" name="saveUpdateAll" id="saveUpdateAll" style="width: 75px; height: 40px; margin-right:20px">Save</a>    
    <a href="{{ route('assessmentSessions.index') }}" class="btn btn-danger mt-4">Cancel</a>
</div>
</div>
</div>

<!-- Modals -->
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
                <input type="hidden" id="assesseRowId">
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
        <br><br>
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

    var models = {!! json_encode($models) !!};
    var add_models = [];
    var participants = {!! json_encode($participants) !!};
    var add_participants = [];
    var deleted_participants = [];
    var deleted_models = [];
    var assessmentId = {!! json_encode($assessmentId) !!}; 
    var assessmentSession = {!! json_encode($assessmentSession) !!};

    var assessment = {};
    assessment.status = "";
    assessment.expired = "";
    assessment.category = "";
    assessment.name = "";
    assessment.start_date = null;
    assessment.end_date = null;

    $("#statusOriginal").val(assessmentSession["status"]);
    $("#category").val(assessmentSession["category"]);
    $("#expired").val(assessmentSession["expired"]);

    $("#addModel").on("click", function(){

        var model = $("#model option:selected").text();
        var count = document.getElementsByClassName("models");

        add_models.push($("#model").val());

        $("#tableModel").find("tbody").append("<tr class='models'><td>" + (count.length + 1) + "</td><td>" + model + "</td><td><a data='new' id='" + (count.length + 1) + "' class='btn btn-danger deletes'>Delete</a></td></tr>");

    });

    $(document).on("click", "a.deletes", function(){

        var data = $(this).attr("data");

        var index = $(this).closest("tr").index();

        $(this).closest("tr").remove();

        if(data == "original")
        {
            deleted_models.push(models[index]["id"]);
        }
        else if(data == "new")
        {
            add_models.splice(index - models.length, 1);
        }
    });

    $("#add").on("click", function(){

        $("#addParticipant").modal("toggle");

    });

    $(document).on("click", "button.addAssessor", function(){

        $("#addAssessor").modal("toggle");

        $("#row_id").val(this.id);

        var tr = $(this).closest("tr").prev();

        $("#assesseRowId").val(tr.attr("id"));
    });


    // Save Assessee 

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

                html = html.concat("<td>" + data["assesse"].name + "</td><td>" + data["assesse"].email + "</td><td><span class='badge' style='background-color: #4fd6a2;'>1</span></td>");
                html = html.concat('<td><a href="#" data="new" class="deleteAssesse" id="' + tr + '"><i class="fa fa-minus-circle" style="color: red; font-size: 20px;"></i></a></td>');
                html = html.concat('<td><a data-toggle="collapse" href="#collapse' + tr  +'"><i class="fa fa-angle-double-down" style="font-size: 20px;"></i></a></td></tr>');
                html = html.concat('<tr class=row_tbody><td colspan="3" style="padding: 0;"><div id="collapse' + tr + '" class="panel-collapse collapse">');
                html = html.concat('<h3><span class="badge" >Assessor List</span><button id="' + tr  + '" class="btn addAssessor" style="float: right;"><span class="badge" style="background-color: #4fd6a2;">Add Accessor</span></button></h3>');
                html = html.concat('<table class="table" style="margin-bottom: 10px;">');
                html = html.concat('<thead><tr><th>Name</th><th>Email</th><th>Relationship</th><th>Status</th><th>&nbsp;</th></tr></thead>');
                html = html.concat('<tbody id="rowAssessor' + tr + '"><tr class="colAssessor"><td>' + data["assessor"].name +'</td><td>' + data["assessor"].email +'</td><td>' + relationship +'</td><td>' + status +'</td><td><a href="#" class="deleteAssessor" id="' + tr + '"><i class="fa fa-minus-circle" style="color: red; font-size: 20px;"></i></a></td></tr></tbody></table></div></td></tr>');

                var assessor1 = {
                    name: data["assessor"].name,
                    email: data["assessor"].email,
                    id: ""
                }

                var detail = {
                    id: tr,
                    assesse : data["assesse"],
                    assessor : assessor1,
                    relation : relationship,
                    status : status,
                }

                add_participants.push(detail);

                $(".table").find("#tbody").append(html);   
            }
        })
    });    

    $("#saveAssessor").on("click", function(){

        var assessor = $("#assessor1").val();
        var status = $("#status1").val();
        var relationship = $("#relation1").val();
        var assesseRowId = $("#assesseRowId").val();
        var tr = $(".rowAssesse").length - 1;

        var td = $("#" + assesseRowId).find("td");

        var row_id = $("#row_id").val();            
        
        $.ajax({
            url: "{{ route('participant.cari') }}",
            method: "GET",
            data: {
                assesse: "",
                assessor: assessor
            },
            success: function(data){

                var html = '<tr class="colAssessor"><td>' + data["assessor"].name +'</td><td>' + data["assessor"].email +'</td><td>' + relationship +'</td><td>' + status +'</td><td><a href="#" class="deleteAssessor" id="' + $("#row_id").val() + '"><i class="fa fa-minus-circle" style="color: red; font-size: 20px;"></i></a></td></tr>';

                $(".table").find("#rowAssessor" + $("#row_id").val()).append(html);

                var td = $("#rowAssesse" + $("#row_id").val()).find("td");

                var count = $("#rowAssessor" + $("#row_id").val()).find($(".colAssessor")).length;

                td.find("span").html(count); 

                $("#addAssessor").modal("hide");

                var assessor1 = {
                    name: data["assessor"].name,
                    email: data["assessor"].email
                }

                var row = document.getElementById("rowAssesse" + row_id);
                var td = row.getElementsByTagName("td");

                var assesse = {
                    name: td[0].innerHTML,
                    email: td[1].innerHTML,
                    id: ""
                }

                var detail = {
                    id: row_id,
                    assesse : assesse,
                    assessor : assessor1,
                    relation : "",
                    status : status
                }

                add_participants.push(detail);
            }
        })
    });


    $(document).on("click", "a.deleteAssesse", function(){

        var id = $(this).attr("id");


        if($(this).attr("data") == "original")
        {   
            var length = participants[id]["assessor"].length;

            for(var i = 0; i < length; i++)
            {   
                deleted_participants.push(participants[id]["assessor"][i]["assessor_map"]);
            }
        }
        else if($(this).attr("data") == "new")
        {
            for(var i = 0; i < add_participants.length; i++)
            {
                if(add_participants[i].id == id)
                {
                    add_participants.splice(i, 1);
                }
            }
        }

        var index = $(this).closest("tr").index();

        var tr = document.getElementById("tbody").deleteRow(index);
        var tr = document.getElementById("tbody").deleteRow(index);

    });

    $(document).on("click", "a.deleteAssessor", function(){

        var index = $(this).closest("tr").index();

        var id = this.id;

        if($(this).attr("data") == "original")
        {
            deleted_participants.push(participants[id]["assessor"][index]["assessor_map"]);
        }
        else if($(this).attr("data") == "new")
        {
            add_participants[id].assessor.splice(index - participants[id]["assessor"].length, 1);
        }

        var tr = document.getElementById("rowAssessor" + id);

        $(this).closest("tr").remove();

        var td = $("#rowAssesse" + id).find("td");

        var count = $("#rowAssessor" + id).find($(".colAssessor")).length;

        td.find("span").html(count); 
    });

    $("#saveUpdateAll").on("click", function(){

        function setHeader(data){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': data
                }
            });
        }

        assessment.name = $("#name").val();
        assessment.status = $("#statusOriginal").val();
        assessment.expired = $("#expired").val();
        assessment.category = $("#category").val();
        assessment.start_date = $("#start_date").val();
        assessment.end_date = $("#end_date").val();

        setHeader($('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: "{{ route('updatesesi') }}",
            method: "post",
            data: {
                id: assessmentId,  
                assessment: assessment
            },
            success: function(data)
            {
        
            }
        })

        if(deleted_models.length > 0)
        {
            $.ajax({
                url: "{{ route('updatedeleteModel') }}",
                method: "post",
                data: {
                    id: assessmentId,  
                    deleted_models: deleted_models,
                },
                success: function(data)
                {
                    
                }
            })
        }

        if(deleted_participants.length > 0)
        {
            $.ajax({
                url: "{{ route('updatedeleteParticipant') }}",
                method: "post",
                data: {
                    id: assessmentId,  
                    deleted_participants: deleted_participants,
                },
                success: function(data)
                {
                    
                }
            })
        }

        if(add_models.length > 0)
        {
            $.ajax({
                url: "{{ route('updateinsertModel') }}",
                method: "post",
                data: {
                    id: assessmentId,  
                    add_models: add_models,
                },
                success: function(data)
                {
                    
                }
            })
        }

        if(add_participants.length > 0)
        {   
            var ids = [];

            for(var i = 0; i < add_participants.length; i++)
            {
                var index = i;

                var participant = add_participants[i];

                $.ajax({
                    url: "{{ route('participant.cariId') }}",
                    data: {
                        assesse: add_participants[i]["assesse"]["name"],
                        assessor: add_participants[i]["assessor"]["name"],
                    },
                    success: function(data)
                    {    
                       $.ajax({
                            url: "{{ route('updateinsertParticipant') }}",
                            method: "post",
                            data: {
                                id: assessmentId,  
                                ids: data["assessor"].id,
                                idss: data["assesse"].id,
                                add_participants: participant,
                            },
                            success: function(data)
                            {
                                
                            }
                        })
                    }
                })
            }
            
           
        }

        swal({
            title: "Berhasil",
            className: "SweatAlert",
            text: "Berhasil Mengedit Assessment Session", 
            icon: "success"
        })
        .then((willDelete) => {
            if (willDelete) {
                window.history.back();
            } 
        });



    });


}); 

</script>





