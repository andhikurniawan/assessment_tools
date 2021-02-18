@extends('main')

@section('title', 'Create Session')

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
        <a href="{!! route('assessmentSessions.index') !!}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Tambah Sesi Assessment</h1>
        </div>
    </div>
   
   
        <div class="card shadow mb-4">
        @include('adminlte-templates::common.errors')
        <div class="card-body">
       
                    {!! Form::open(['route' => 'assessmentSessions.store', 'id'=>'form1'])!!}
                       
                        @include('assessment__sessions.fields')

                        <div style="float: right; margin-top: 50px;margin-bottom: 10px; margin-right: 20px;">
                        <input type="submit" id="submitButton" value="Save & Next Select Competency Model" style="border: none; background: none; color: blue;"><i style="color: blue;" class="fas fa-angle-right"></i>
                        </div>
                                        
                    {!! Form::close() !!}
                    
                    </div>
              </div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">

    var name;
    var start_date;
    var end_date;

    $("#name").change(function() {

        name = this.value;
    });

    $("#submitButton").on("click", function(){

        if(name != "" && (typeof start_date != "undefined" && typeof start_date != null) && (typeof end_date != "undefined" && typeof end_date != null))
        {
            if(start_date.getTime() < end_date.getTime())
            {
                document.getElementById("form1").submit();
            }
            else if(start_date.getTime() > end_date.getTime())
            {   
                $("form").submit(function(e){
                    e.preventDefault();
                });

                swal("Error", "End Date Harus Setelah Start Date", "error");
            }
        }
        else if(name == "" || start_date == null || end_date == null)
        {   
            $("form").submit(function(e){
                e.preventDefault();
            });

            swal("Error", "Silahkan Mengisi Semua Input Yang Ada Sebelum Lanjut", "error");
        }
    });

    $("#start_date").change(function(){
        start_date = new Date(this.value);
    });

    $("#end_date").change(function(){
        end_date = new Date(this.value)
    });

</script>
@endsection
