@extends('main')
@section('title', 'Employee')
@section('dashboard', 'active')
@section('user', 'hidden')
@section('superadmin', 'hidden')            
@section('admin', 'hidden')            
@section('admin_pm', 'hidden')            
@section('admin_ot', 'hidden')   
@section('content')
<h1>Halo, {{ Auth::user()->name }}</h1>
@endsection
