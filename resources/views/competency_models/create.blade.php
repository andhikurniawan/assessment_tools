@extends('main')

@section('title', 'Select Competency Model')

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
            <h1 class="d-inline h3 text-gray-800">Pilih Competency Model</h1>
        </div>
    </div>
   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Competency Model</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered text-center mb-4" id="datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>NAME</td>
                            <td>ACTION</td>
                        </tr>
                    </thead>
                    <tbody id="model-table">

                    </tbody>
                </table>

                
            <label class="mt-4">Add Competency Model</label>
           <select id ="model" class="form-control" style="height: 40px; width: 300px; margin-top: 10px;">
                    @foreach($models as $model)
                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                    @endforeach
                </select>
                <br><br>
                <button id="add" class="btn btn-primary btn-md" style="width: 60px; font-size: 14px; margin-top: -10px;">Add</button>
                <form method="post" id="form" action="{{ route('competencyModel.store') }}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type=hidden id="idmodels" name="model[]">
                
                <div style="float: right; margin-top: 10px;margin-bottom: 10px; margin-right: 10px;">
                     <input type="submit" id="submitButton" value="Save & Next Mapping Participants" style="border: none; background: none; color: blue;"><i style="color: blue;" class="fas fa-angle-right"></i>
                 </div>
               
                </form>
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

            $("#datatable").find("tbody").append("<tr class='models'><td>" + (count.length + 1) + "</td><td>" + model + "</td><td><button id='" + (count.length + 1) + "' class='btn btn-danger deletes'>Delete</td></tr>");
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
@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection
