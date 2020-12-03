@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 style="margin-top:20px">
            Assessment  Session
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'assessmentSessions.store', 'id'=>'form1'])!!}

                        @include('assessment__sessions.fields')

                        <div style="float: right; margin-top: 50px;margin-bottom: 10px; margin-right: 20px;">
                        <input type="submit" id="submitButton" value="Save & Next Select Competency Model" style="border: none; background: none; color: blue;"><i style="color: blue;" class="glyphicon glyphicon-menu-right"></i>
                        </div>
                                        
                    {!! Form::close() !!}
                </div>
            </div>
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
