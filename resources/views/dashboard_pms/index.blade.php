@extends('main')

@section('title', 'Dashboard Profile Matching')

@section('Dashboard', 'active')
@switch(session('permission'))
    @case('admin_pm')           
    @section('superadmin', 'hidden')
        @section('admin', 'hidden')            
        @section('admin_tnd', 'hidden')            
        @section('admin_ap', 'hidden')            
        @section('admin_ot', 'hidden')            
        @break
    @case('admin')
        @section('superadmin', 'hidden')                
            @break
    @default

@endswitch
@section('content')

        <h1 class="h3 mb-0 text-gray-800">Dashboard Profile Matching</h1>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

<br>

<div class="row">
        <div class="col-xl">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Grup Kompetensi</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center m-0 font-weight-bold text-primary">{{$grupkompetensi}}</h1>
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Seluruh Kompetensi</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center m-0 font-weight-bold text-primary">{{$kompetensi}}</h1>
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">Kamus Kompetensi</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center m-0 font-weight-bold text-primary">{{$kamus}}</h1>
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Model Kompetensi</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center m-0 font-weight-bold text-primary">{{$modelkompetensi}}</h1>
                </div>
            </div>
        </div>
    </div>    

<br>
     <!-- Kamus Kompetensi-->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kamus Kompetensi</h6>
        </div>
        <div class="card-body">
        @include('dashboard_pms.table')
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