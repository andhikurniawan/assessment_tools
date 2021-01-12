@extends('layouts.app')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
    
        <div class="row">
            <div class="col-sm-6" style="margin-left:15px">
                <select id="models" class="form-control" style="width: 250px;">
                @foreach($models as $model)
                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="col-sm-4" style="margin-left:150px">
                <button class="btn btn-success" id="btnsubmit" style="float: right;"><i style="font-size: 12px;" class="fa fa-check-square-o"></i>&nbsp;&nbsp;Finish</button>
            </div>
        </div>
        
    </div>
    <br>
    <form method="post" id="formsubmit" action="{{ route('session.simpan') }}">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <input type="hidden" name="session" value="{{ $session }}">
    <input type="hidden" name="assesse" value="{{ $assesse }}">
    <input type="hidden" name="relation" value="{{ $relation }}">
    @foreach($models as $model)
        <input type="hidden" name="models[]" value="{{ $model->id }}">
    @endforeach
    @foreach($questionss as $keys => $questions)
        @if($keys == 0)
            <div class="container" id="models-{{ $models[$keys]->id }}" style="display: block;">
        @elseif($keys > 0)
            <div class="container" id="models-{{ $models[$keys]->id }}" style="display: none;">
        @endif
            @foreach($questions as $key => $question) 
                @if($key < 1)
                    <div class="container page-{{ $models[$keys]->id . '-' . (floor(($key / 1)) + 1)  }}" style="display: block;">
                @else
                    <div class="container page-{{ $models[$keys]->id . '-' . (floor(($key / 1)) + 1)  }}" style="display: none;">
                @endif  
                <div class="row">  
                   <div class="col-sm-6">
                   <div class="box box-primary" style="height:520px">
            <div class="box-body">
            <div class="panel panel-default" style="height: 35px; background-color:#f1f3de">
                <div class="panel-body"> 
                   <strong><p style="text-align:center; font-size:18px; margin-top:-10px">Question #{{ $key + 1}}</p></strong>
                </div>
                </div>
                        <h5>{{$question->question }}</h5>
                    </div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="box box-primary" style="height:520px">
            <div class="box-body">
            <div class="panel panel-default" style="height: 35px; background-color:#f1f3de">
                <div class="panel-body"> 
                   <strong><p style="text-align:center; font-size:18px; margin-top:-10px">Choose the best option</p></strong>
                </div>
                </div>
                        <ul class="list-group">
                        @foreach($question->key_behaviour as $key_behaviour)
                            <li class="list-group-item"><input type="radio" name="{{ $models[$keys]->id . '-' .  $key }}" value="{{ $question->competency_id . '-' . $key_behaviour->level }}">&nbsp;{{ $key_behaviour->description }}</li> 
                        @endforeach
                        </ul>
                    </div>
                    </div>
                    </div>
                    </div>

                </div>  
            @endforeach
        </div>
    @endforeach
    </form>
    
    @foreach($questionss as $key => $questions)
        @if($key == 0)
            <div class="container" id="pagination-{{ $questions[0]->competency_models_id }}" style="margin-left: 1.2%; display: block;">
        @elseif($key > 0)
            <div class="container" id="pagination-{{ $questions[0]->competency_models_id }}" style="display: none;">
        @endif
            <nav aria-label="Page navigation example" style="margin: 0 auto;">
                <ul class="pagination">
                    @if(count($questions) % 1 == 0)
                        @for($i = 0; $i < count($questions) / 1; $i++)
                            @if($i == 0)
                                <li class="page-item num-page active"><a class="page-link page" id="{{ $i + 1 }}" href="#">{{ $i + 1 }}</a></li>
                            @elseif($i > 0)
                                <li class="page-item num-page"><a class="page-link page" id="{{ $i + 1 }}" href="#">{{ $i + 1 }}</a></li>
                            @endif
                        @endfor
                    @elseif(count($questions) % 1 != 0)
                        @for($i = 0; $i < round((count($questions)) / 1) + 1; $i++)
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
    @endforeach
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">

$(document).ready(function(){
    var models = {!! json_encode($models) !!};
    var questions = {!! json_encode($questionss) !!};
    var curr_id = models[0]["id"];
    var prev_id = models[0]["id"];
    var curr_page = 1;
    var prev_page = 1;
    var radios = $("input[type='radio']");

    
    
    $(document).on("click", "a.page" , function() {
        
        prev_page = curr_page
        curr_page = this.id

        $("#pagination-" + curr_id).find(".active").removeClass("active");

        $(this).parent().addClass("active");

        $(".page-" + curr_id + "-" + prev_page).css("display", "none");

        $(".page-" + curr_id + "-" + curr_page).css("display", "block");
    });

    $("#btnsubmit").on("click", function(){

        var question_count = 0;
        var checked = 0;

        for(var i = 0; i < models.length; i++)
        {   
            question_count += questions[i].length;

            for(var j = 0; j < questions[i].length; j++)
            {   
                var radio = document.getElementsByName(models[i]["id"] + "-" + j);
                
                for(var k = 0; k < radio.length; k++)
                {
                    if(radio[k].checked == true)
                    {
                        checked++;
                    }
                }

                //$("input[name='" + models[i]["id"] + "-" + j + "']").first().attr("checked", true);
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
                text: "Ada Pertanyaan Yang Belum Terisi", 
                icon: "warning"
            })
        }

        

    }); 

    $("#models").on("change", function(){

        prev_id = curr_id;
        curr_id = this.value;

        $("#pagination-" + prev_id).css("display", "none");

        $("#pagination-" + curr_id).css("display", "block");

        $("#models-" + prev_id).css("display", "none");

        $("#models-" + curr_id).css("display", "block");

    });

});

</script>

@endsection