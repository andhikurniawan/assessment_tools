@extends('main')

@section('title', 'Assessment Session')

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
    @case('admin')
        @section('superadmin', 'hidden')                
            @break
    @default

@endswitch

@section('content')
<div class="card shadow mb-4 ml-4 mr-4">
<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Session</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr class="table-light">   
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;Assessment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>{{ $session_id->name }}</td>
                    </tr>
                    <tr class="table-light">   
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;Start Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>{{ date('M d, Y', strtotime($session_id->start_date)) }}</td>
                    </tr>
                    <tr class="table-light">   
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;End Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>{{ date('M d, Y', strtotime($session_id->end_date)) }}</td>
                    </tr>
                    <tr class="table-light">   
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;Assesse Name &nbsp;:</td>
                        <td>{{ $assesse_id->name }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>      
<button class="btn btn-success mb-4" id="btnsubmit" style="margin-left:90%"><i class="fas fa-check-circle"></i> Finish</button>
      
    <form method="post" id="formsubmit" action="{{ route('session.simpan') }}">
    
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <input type="hidden" name="session" value="{{ $session }}">
    <input type="hidden" name="assesse" value="{{ $assesse }}">
    <input type="hidden" name="relation" value="{{ $relation }}"> 
    <input type="hidden" name="count" id="count">
    
  
        @foreach($questionss as $key => $question)
            @if($key < 5)
                <div class="container page-{{ (floor(($key / 5)) + 1)  }}" style="display: block;">
            @else
                <div class="container page-{{ (floor(($key / 5)) + 1)  }}" style="display: none;">
            @endif
            <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pertanyaan #{{$key + 1 }}</h6>
        </div>
        <div class="card-body">    
               
         <h5 class="text-dark" style="margin-top:-10px">{{$question->question }}</h5>

            <ul class="list-group">
            <h6 class="text-primary" style="margin-top: 10px">Pilih salah satu jawaban yang terbaik :</h6>
             @foreach($question->key_behaviour as $key_behaviour)
                <li class="list-group-item" style="margin-top:10px"><input type="radio" id="answer" name="{{ $key }}" value="{{ $question->id . '-' . $key_behaviour->level }}">&nbsp;{{ $key_behaviour->key_behaviour }}</li> 
             @endforeach
            </ul>
            
            </div>  
            </div>
    </div>
        @endforeach

   
    
    </form>
    
    <div class="container" style="margin-left: 45%; margin-rigth: 50%; display: block;">
        <nav aria-label="Page navigation example" style="margin: 0 auto;">
            <ul class="pagination">
                @if(count($questionss) % 5 == 0)
                    @for($i = 0; $i < count($questionss) / 5; $i++)
                        @if($i == 0)
                            <li class="page-item num-page active"><a class="page-link page" id="{{ $i + 1 }}" href="#">{{ $i + 1 }}</a></li>
                        @elseif($i > 0)
                            <li class="page-item num-page"><a class="page-link page" id="{{ $i + 1 }}" href="#">{{ $i + 1 }}</a></li>
                        @endif
                    @endfor
                @elseif(count($questionss) % 5 != 0)
                    @for($i = 0; $i < floor((count($questionss)) / 5) + 1; $i++)
                        @if($i == 0)
                            <li class="page-item num-page active"><a class="page-link page" id="{{ $i + 1 }}" href="#">{{ $i + 1 }}</a></li>
                        @elseif($i > 0)
                            <li class="page-item num-page"><a class="page-link page" id="{{ $i + 1 }}" href="#">{{ $i + 1 }}</a></li>
                        @endif
                    @endfor
                @endif
            </ul>
        </nav>
        
    </div>
   


<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">

$(document).ready(function(){

    var questions = {!! json_encode($questionss) !!};
    var curr_page = 1;
    var prev_page = 1;
    var radios = $("input[type='radio']");

    $("#count").val(questions.length);

    $(document).on("click", "a.page" , function() {
        
        prev_page = curr_page
        curr_page = this.id

        $("ul.pagination").find(".active").removeClass("active");

        $(this).parent().addClass("active");

        $(".page-" + prev_page).css("display", "none");

        $(".page-" + curr_page).css("display", "block");
    });

    $("#btnsubmit").on("click", function(){

        var question_count = questions.length;
        var checked = 0;

        for(var i = 0; i < questions.length; i++)
        {   
            var radio = document.getElementsByName(i);
                
            for(var k = 0; k < radio.length; k++)
            {
                if(radio[k].checked == true)
                {
                    checked++;
                }
            }
        };

        if(checked == question_count )
        {
            swal({
                title: "Berhasil",
                text: "Semua Jawaban Berhasil Tersimpan", 
                icon: "success"
            })
            .then((willDelete) => {
                if (willDelete) {
                    $("#formsubmit").submit();
                } 
            });
        }
        else if(checked < question_count)
        {
            swal({
                title: "Error",
                className: "Swalalert",
                text: "Ada Pertanyaan Yang Belum Terisi", 
                icon: "warning"
            })
        }

        

    }); 
});

</script>

@endsection