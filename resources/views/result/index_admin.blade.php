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
<div class="text-left mt-4">
        <h1 class="d-inline h3 text-gray-800">Assessment Result</h1>
        <br>
            <br>
            <h1 class=" h4 text-gray-800">Perusahaan</h1>
            <select name="company" id="company" class="form-control"
                onchange="window.location.href=this.options[this.selectedIndex].value;">
                @if (Auth::user()->company_id != null)
                <option value="{{$company->id}}" selected>{{ $company->name}}</option>
                    
                @else
                <option value="{{ url('result/') }}">Semua Asessment Session</option>
                @foreach ($company as $item)
                    <option value="{{ url('result/company', $item->id) }}"
                        {{ $selected == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                @endforeach    
                @endif
            </select>     
            
            </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Session</h6>
        </div>
        <div class="card-body">
        <form method="post" id="formsubmit" action="{{ route('result.detail') }}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" name="id" id="session_id">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>PARTICIPANS</th>
                        <th>STATUS</th>
                        <th>COMPANY</th>
                        <th>DATE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>    
                <tbody>
                    @foreach($assessments as $a)
                        <tr>
                            <td>{{ $a->name }}</td>
                            <td>{{ $a->counts }}</td>
                            <td>{{ $a->status }}</td>
                            <td>{{ $a->company_name }}</td>
                            <td>{{ date('M d, Y', strtotime($a->start_date)) }}</td>
                            <td><a href="#" class="btnSubmit" id="{{ $a->id }}"><button class="btn btn-warning">View</button></a></td>
                            </form>
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

        $("#tableAssessment").DataTable();

        $(document).on("click", "a.btnSubmit", function(){

            $("#session_id").val(this.id);

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