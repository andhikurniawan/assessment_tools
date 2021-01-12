@extends('layouts.app')

@section('content')
    <section class="content-header">
    <div class="container-fluid">
        <h1>Welcome! {{ Auth::user()->name }}</h1>
        <h1 class="pull-right">
           <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('competencyModels.create') }}">Add New</a>
           </h1> 
           
           <div class ="container">
        <h3 style="margin-left: -16px;">Kelola Model Kompetensi</h3> 
        
        
        <form action="#" method="get" >
        <div class="col-xs-4">
        <div class="input-group">
                <input type="text" name="q" class="form-control" style="margin-left: -32px;" placeholder="Search..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' style="margin-left: -32px;" class="btn btn-flat"><i class="fa fa-search"></i>
            </button> 
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
                    @include('competency__models.table')
            </div>
            </div>
      
      <div class="text-center">
  
      </div>
      </div>
      </div>


@endsection

