@extends('main')

@section('title', 'Daftar Model Kompetensi')

@section('ModelKompetensi', 'active')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Model Kompetensi</h1>
        <div class="text-right">
            <a href="{{ route('competencyModels.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambah Model Kompetensi</a>
             </div>

    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

 <!-- Daftar Model Kompetensi-->
 <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kompetensi</h6>
        </div>
        <div class="card-body">
        @include('competency__models.table')
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



