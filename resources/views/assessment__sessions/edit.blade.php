@extends('main')

@section('title', 'Edit Session')

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
        <div class="text-left">
        <a href="{!! route('assessmentSessions.index') !!}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Edit Sesi Assessment</h1>
        </div>
    </div>
   
   @include('assessment__sessions.fields_edit')
       
@endsection