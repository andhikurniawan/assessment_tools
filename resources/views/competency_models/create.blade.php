@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           Select Competency Model
        </h1>
    </section>
    <div class="content">
       
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    
            <div class="container" style="margin-left:10px">

                <label>Competency Model</label>
                <br><br> 
                <table class="table text-center" id="table" style="width:70%">
                    <thead style="background-color:#f0f5fc;">
                        <tr>
                            <td>#</td>
                            <td>NAME</td>
                            <td>ACTION</td>
                        </tr>
                    </thead>
                    <tbody id="model-table">

                    </tbody>
                </table>
                <br><br>
                <br>
                <label>Add Competency Model</label>
                <select id ="model" class="form-control" style="height: 40px; width: 300px; margin-top: 10px;">
                    @foreach($models as $model)
                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                    @endforeach
                </select>
                <br><br>
                <button id="add" class="btn btn-primary btn-md" style="width: 60px; font-size: 14px; margin-top: -10px;">Add</button>
                <form method="post" id="form" action="{{ route('competencyModels.store') }}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type=hidden id="idmodels" name="model[]">
                
                <div style="float: right; margin-top: 10px;margin-bottom: 10px; margin-right: 70px;">
                     <input type="submit" id="submitButton" value="Save & Next Mapping Participants" style="border: none; background: none; color: blue;"><i style="color: blue;" class="glyphicon glyphicon-menu-right"></i>
                 </div>
               
                </form>
            </div>
        

                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">

        $(document).ready(function() {

        var arr = [];

        $("#add").on("click", function(){

            var model = $("#model option:selected").text();
            var count = document.getElementsByClassName("models");

            arr.push($("#model").val());

            $("#table").find("tbody").append("<tr class='models'><td>" + (count.length + 1) + "</td><td>" + model + "</td><td><button id='" + (count.length + 1) + "' class='btn btn-danger deletes'>Delete</td></tr>");
        }); 

        $(".btn-danger").on("click", function(){

            alert("deleted");
                
        }); 

        $(document).on("click", "button.deletes", function(){

            var index = $(this).closest("tr").index();

            arr.splice(index, 1);

            $(this).closest("tr").remove();
        });

        $("#submitButton").on("click", function(){
            
            var model_count = arr.length;

            if(model_count == 0)
            {   
                $("#form").submit(function(e){
                    e.preventDefault();
                });

                swal("Info", "Silahkan Menambahkan Competency Model Terlebih Dahulu Sebelum Lanjut", "info");
            }
            else if(model_count > 0)
            {   
                $("#idmodels").val(arr);

                document.getElementById("form").submit();
            }
        });

        });

</script>
@endsection
