@extends('main')

@section('title', 'Gap Analysis')

@section('GapAnalysis', 'active')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gap Analysis</h1>


    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

 <!-- Daftar Model Kompetensi-->
 <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hasil Gap Analysis</h6>
        </div>
        <div class="card-body">
        @include('gap__analyses.table')
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

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Gap Analysis</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('gapAnalyses.create') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('gap__analyses.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

