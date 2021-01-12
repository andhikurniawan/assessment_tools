@extends('templates.template')

@section('content')
<div class="container">
    <div class="row">
    <h1 class="pull-left" style="margin-top: 10px; margin-bottom: 35px">Welcome, {{ Auth::user()->name }} !</h1>

    </div>
</div>
@endsection
