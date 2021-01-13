@extends('main')

@section('title', 'Edit Session')

@section('SesiAssessment', 'active')

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