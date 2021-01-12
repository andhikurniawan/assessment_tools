@extends('templates.template')

@section('content')
    <section class="content-header" >
        <h1 class="pull-left" style="margin-top: 10px; margin-bottom: 35px">Welcome, {{ Auth::user()->name }} !</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="container-fluid" style="margin-left:-15px">
    <div class="row">

        <div class="col-md-3">
            <!-- komponen panel di sini  -->
            <a href="{{ route('assessmentSessions.index') }}">
            <div class="panel panel-default" style="height: 115px">
                <div class="panel-body">
                   <p style="text-align:center">All Session</p> 
                   <strong><p style="text-align:center; font-size:32px">10</p></strong>
                    
                </div>
                </div>
                </a>
        </div>

        <div class="col-md-3">
            <!-- komponen panel di sini  -->
            <div class="panel panel-default" style="height: 115px">
                <div class="panel-body">
                   <p style="text-align:center">Open</p> 
                   <strong><p style="text-align:center; font-size:32px">10</p></strong>
                    
                </div>
                </div>
        </div>

        <div class="col-md-3">
            <!-- komponen panel di sini  -->
            <div class="panel panel-default" style="height: 115px">
                <div class="panel-body">
                   <p style="text-align:center">Not Started</p> 
                   <strong><p style="text-align:center; font-size:32px">10</p></strong>
                    
                </div>
                </div>
        </div>

        <div class="col-md-3">
            <!-- komponen panel di sini  -->
            <div class="panel panel-default" style="height: 115px">
                <div class="panel-body">
                   <p style="text-align:center">Finished</p> 
                   <strong><p style="text-align:center; font-size:32px">10</p></strong>
                    
                </div>
                </div>
        </div>

    </div>
</div>
<div class="container">
<div class="row" style="margin-bottom: 20px; margin-left:-25px; margin-top: 20px;" >
 <br>
    <div class="col-sm-3">
     <h4 style="margin-bottom:-5px;">All Session</h4>
    </div>
    <!-- <div class="col-sm-8" style="margin-left:-190px" >
       <form action="/search" method="get" class="form-inline">
       <div class="form-group">     
       <div class="input-group">
       <input type="search" name="search" class="form-control"> 
       </div>      
       </div>
       <button type="submit" class="btn btn-primary">Search</button>
       </form>
    </div> -->

    <div class="col-sm-2"  style="margin-left:665px">
        <a href="{{ route('assessmentSessions.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Session</a>                  
    </div>
           
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('assessment__sessions.table')
                    
            </div>
           
        </div>
        
    </div>
@endsection

