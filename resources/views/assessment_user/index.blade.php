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
        <h1 class="h3 mb-4 text-gray-800">Halo, {{ Auth::user()->name }}</h1>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Assessment Session</h1>

        </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Session</h6>
        </div>
        <div class="card-body">

        <form method="post" action="{{ route('assessmentUser.detail') }}" id="formsubmit">
        <input type="hidden" value="" id="session_id" name="id">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
       
        <table class="table text-center table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>PARTICIPANTS</th>
                    <th>STATUS</th>
                    <th>START DATE</th>
                    <th>END DATE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>       
                @foreach($assessments as $assessment)
                    <tr>
                        <td>{{ $assessment->name }}</td>
                        <td>{{ $assessment->counts }}</td>
                        <td>{{ $assessment->status }}</td>
                        <td>{{ $assessment->start_date }}</td>
                        <td>{{ $assessment->end_date }}</td>   
                        <td> <button id="{{ $assessment->id }}" class="btn btn-warning btnsubmit">View</button>  </td>
                      
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

    $('#table_id').DataTable();

    $(document).on("click", "button.btnsubmit" , function() {

        document.getElementById("session_id").value = this.id;

        // alert($("#session_id").val());

        // $("#formsubmit").submit();

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
