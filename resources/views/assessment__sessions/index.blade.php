@extends('main')

@section('title', 'Assessment Session')

@section('SesiAssessment', 'active')

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
                    <h1 class="text-center m-0 font-weight-bold" id="training">10</h1>
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
                    <h1 class="text-center m-0 font-weight-bold" id="training">10</h1>
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
                    <h1 class="text-center m-0 font-weight-bold" id="training">10</h1>
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
                    <h1 class="text-center m-0 font-weight-bold" id="training">10</h1>
                </div>
            </div>
        </div>

        </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Assessment Session</h1>
        <div class="text-right">
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

