@extends('main')
@section('title', 'Dashboard')
@section('dashboard', 'active')
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
<div class="container">
    <div class="row">
    <h1 class="pull-left" style="margin-top: 10px; margin-bottom: 35px">Welcome, {{ Auth::user()->name }} !</h1>
@endsection
