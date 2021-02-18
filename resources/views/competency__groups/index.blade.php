@extends('main')

@section('title', 'Daftar Grup Kompetensi')

@section('GrupKompetensi', 'active')
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

        <h1 class="h3 mb-0 text-gray-800">Kelola Grup Kompetensi</h1>
      

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
<div class="text-left mt-4">

    <h1 class=" h5 text-gray-800">Pilih Perusahaan</h1>
    <select name="company" id="company" class="form-control"
                onchange="window.location.href=this.options[this.selectedIndex].value;">
                @if (Auth::user()->company_id != null)
                <option value="{{$company->id}}" selected>{{ $company->name}}</option>
                    
                @else
                <option value="{{ url('competencyGroups/') }}">Seluruh Perusahaan</option>
                @foreach ($company as $item)
                    <option value="{{ url('competencyGroups/company', $item->id) }}"
                        {{ $selected == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                @endforeach    
                @endif
            </select>   
            </div>
            <div class="text-right">
            <a href="{{ route('competencyGroups.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambah Grup Kompetensi</a>
             </div>
    </div>

    



 <!-- Daftar Grup Kompetensi-->
 <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Grup Kompetensi</h6>
        </div>
        <div class="card-body">
        @include('competency__groups.table')
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


