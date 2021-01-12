@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left" style="margin-top: 20px;margin-bottom: 10px">Job Targets</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: 20px;margin-bottom: 10px" href="{{ route('jobTargets.create') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('job_targets.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection


