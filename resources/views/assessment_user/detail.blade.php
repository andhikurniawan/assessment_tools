@extends('layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <h3>Assessment Session</h3>

        <div class="box box-primary">
            <div class="box-body">
        <table class="table">
            <tbody>
                <tr class="success">
                    <td style="font-weight: bold;">Name</td>
                    <td>{{ $assessment->name }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Category</td>
                    <td>{{ $assessment->category }}</td>
                </tr>
                <tr class="success">
                    <td style="font-weight: bold;">Status</td>
                    <td>{{ $assessment->status }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Start Date</td>
                    <td>{{ $assessment->start_date }}</td>
                </tr>
                <tr class="success">
                    <td style="font-weight: bold;">Date</td>
                    <td>{{ $assessment->end_date }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Expired</td>
                    <td>{{ $assessment->expired }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>

<!-- Assee Map  -->

    <div class="container-fluid">
    <div class="box box-primary">
            <div class="box-body">

        <label>Assesse Map</label>
        <br><br>
        <form method="post" action="{{ route('session') }}" id="formsubmit">
        <input type="hidden" name="assesse" id="assesseid" value="">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="session" value="{{ $session }}">
        <input type="hidden" name="relation" id="relationship" value="">
        @foreach($models as $model)
            <input type="hidden" name="models[]" value="{{ $model->id }}">
        @endforeach
        <table class="table text-center">
            <thead>
                <tr class="success">
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Relationship</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assessees as $assessee)
                    <tr>
                        <td>{{ $assessee->name }}</td>
                        <td>{{ $assessee->email }}</td>
                        <td>{{ $assessee->relation }}</td>
                        <td>{{ $assessee->status }}</td>
                        @foreach($assessee->assessors as $assessor)
                            @if($id == $assessor)
                                @if($assessee->assessee == $id)
                                    @if($assessee->relation == "Self")
                                        @if($assessee->status != "done")
                                            <td><button class="btn btn-success btnsubmit" id="{{ $assessee->assessee . '-' . $assessee->relation }}"><i style="font-size: 12px;" class="fa fa-play-circle-o"></i>&nbsp;&nbsp;Start</button></td>
                                        @endif
                                    @endif
                                @endif
                                @if($assessee->assessee != $id)
                                    @if($assessee->status != "done")
                                    <td><button class="btn btn-success btnsubmit" id="{{ $assessee->assessee . '-' . $assessee->relation }}"><i style="font-size: 12px;" class="fa fa-play-circle-o"></i>&nbsp;&nbsp;Start</button></td>
                                    @endif
                                @endif
                            @break
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>    
        </form> 
                        </div>
                    </div>
                </div>
            </div>
  
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">

$(document).ready(function(){

    
    $(document).on("click", "button.btnsubmit" , function() {

        var id = this.id;

        id = id.split("-", 2);

        document.getElementById("assesseid").value = id[0];
        document.getElementById("relationship").value = id[1];

        $("#formsubmit").submit();

    });
    
});

</script>

@endsection