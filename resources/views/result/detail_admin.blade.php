@extends('main')

@section('title', 'Report Assessment Session')

@section('ReportAssessment', 'active')
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
        <h1 class="h3 mb-3 text-gray-800">Assessment Result</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Assessment Session</h6>
        </div>
        <div class="card-body">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td class="font-weight-bold">Name</td>
                    <td>{{ $assessment->name }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Category</td>
                    <td>{{ $assessment->category }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold" >Status</td>
                    <td>{{ $assessment->status }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Start Date</td>
                    <td>{{ date('d M Y', strtotime($assessment->start_date)) }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">End Date</td>
                    <td>{{ date('d M Y', strtotime($assessment->end_date)) }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Expired</td>
                    <td>{{ $assessment->expired }}</td>
                </tr>
            </tbody>
        </table>
        </div>
</div>

       
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Participants</h6>
        </div>
        <div class="card-body">
        <form method="post" action="{{ route('result/detail/laporan') }}">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assessees as $a)
                    <tr>    
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->email }}</td> 
                        <td><button id="{{ $a->id . '-' . $session_id }}" class="btn btn-warning btn-submit">View</button></td>
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

        $("#tableAssessee").DataTable();

        $(document).on("click", "button.btn-submit", function(){

            $("#id").val(this.id);

            // alert(this.id);

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