@extends('main')

@section('title', 'Assessment Session')

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
        <h1 class="h3 mb-4 text-gray-800">Halo, {{ Auth::user()->name }}</h1>
    </div>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

   <!-- All session Card Example -->
   <div class="row mt-4 mb-4">
        <div class="col-xl">
   <div class="card border-left-primary shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">All Session</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center m-0 font-weight-bold" id="training">{{$assessment_all}}</h1>
                </div>
            </div>
        </div>


     <!-- All session Card Example -->
     <div class="col-xl">
   <div class="card border-left-warning shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-warning">Not Started</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center m-0 font-weight-bold" id="training">{{$assessment_notStarted}}</h1>
                </div>
            </div>
        </div>

     <!-- All session Card Example -->
     <div class="col-xl">
   <div class="card border-left-info shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-info">Open</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center m-0 font-weight-bold" id="training">{{$assessment_open}}</h1>
                </div>
            </div>
        </div>

     <!-- All session Card Example -->
     <div class="col-xl">
   <div class="card border-left-success shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-success">Finished</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center m-0 font-weight-bold" id="training">{{$assessment_finished}}</h1>
                </div>
            </div>
        </div>

        </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="text-left mt-4">
        <h1 class="d-inline h3 text-gray-800">Assessment Session</h1>
        <br>
            <br>
            <h1 class=" h4 text-gray-800">Perusahaan</h1>
            <select name="company" id="company" class="form-control"
                onchange="window.location.href=this.options[this.selectedIndex].value;">
                @if (Auth::user()->company_id != null)
                <option value="{{$company->id}}" selected>{{ $company->name}}</option>
                    
                @else
                <option value="{{ url('assessmentSessions/') }}">Semua Asessment Session</option>
                @foreach ($company as $item)
                    <option value="{{ url('assessmentSessions/company', $item->id) }}"
                        {{ $selected == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                @endforeach    
                @endif
            </select>     
            
            </div>
        <div class="text-right" style="margin-top:11%">
        <a href="{{ route('assessmentSessions.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Session</a>                  
        </div>
      
            </div>
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Session</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                    @include('assessment__sessions.table')
         </div>
           
        </div>
        </div>
        
    </div>
@endsection
@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection

