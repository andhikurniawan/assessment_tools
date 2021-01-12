@extends('layouts.app')

@section('content')
    <section class="content-header">
    <div class="container-fluid">
    <h1>Welcome! {{ Auth::user()->name }}</h1>
        <h1 class="pull-right">
        <a class="btn btn-success pull-right" style="margin-top: -65px;" href="{{ route('competencies.create') }}">Tambah Kompetensi</a>
        </h1>
        
        
        <div class ="container">
        <h3 style="margin-left: -16px;" >Kelola Seluruh Kompetensi</h3> 
     
        <form action="#" method="get" >
        <div class="col-xs-4">
            <div class="input-group">
                <input type="text" name="q"  style="margin-left: -32px;" class="form-control" size="50px" placeholder="Search..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' style="margin-left: -32px;" id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
            </div>
            </div>
        </form>

        </div>
        </div>
        
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="container-fluid">
        <div class="box box-success">
            <div class="box-body">
            
            @include('competencies.table')
            </div>
        </div>
        <div class="text-center">
        </div>
        </div>
    </div>
@endsection

