@extends('main')

@section('title', 'Detail Kompetensi')
@section('kompetensi', 'active')
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
    <div class="content">
    <div class="card shadow mb-4">
                <div class="card-body">
                    @include('competencies.show_fields')
                    <a href="{{ route('competencies.index') }}" class="btn btn-danger">Back</a>
                </div>
           
        </div>
    </div>
@endsection
