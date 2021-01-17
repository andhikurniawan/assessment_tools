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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
        <a href="{!! route('assessmentSessions.index') !!}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Assessment Session</h1>
        </div>
    </div>
   

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Session</h6>
        </div>
        <div class="card-body">
     
        <table class="table table-striped">
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


<!-- Assee Map  -->

<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Assessee</h6>
        </div>
        <div class="card-body">
        <form method="post" action="{{ route('session') }}" id="formsubmit">
        <input type="hidden" name="assesse" id="assesseid" value="">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="session" value="{{ $session }}">
        <input type="hidden" name="relation" id="relationship" value="">
        @foreach($models as $model)
            <input type="hidden" name="models[]" value="{{ $model->id }}">
        @endforeach
        <table class="table text-center table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                            <td><button class="btn btn-success btnsubmit" id="{{ $assessee->assessee . '-' . $assessee->relation }}"><i class="fa fa-play-circle"></i>&nbsp;&nbsp;Start</button></td>
                                        @endif
                                    @endif
                                @endif
                                @if($assessee->assessee != $id)
                                    @if($assessee->status != "done")
                                    <td><button class="btn btn-success btnsubmit" id="{{ $assessee->assessee . '-' . $assessee->relation }}"><i class="fas fa-play-circle"></i>&nbsp;&nbsp;Start</button></td>
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
@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection
