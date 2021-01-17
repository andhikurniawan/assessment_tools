@extends('layouts.app')

@section('content')
    <section class="content-header">
    <div class="container-fluid">
        <h1 class="pull-left" style="margin-left: -16px;">Key Behaviours</h1>
        <h1 class="pull-right">
           <a class="btn btn-success" style="margin-top: 5px;margin-bottom: 5px; margin-right:-16px;" href="{{ route('keyBehaviours.create') }}">Add New</a>
        </h1>
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-success">
            <div class="box-body">
                    @include('key__behaviours.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

