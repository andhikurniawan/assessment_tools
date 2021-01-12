@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Job Requirement
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($jobRequirement, ['route' => ['jobRequirements.update', $jobRequirement->id], 'method' => 'patch']) !!}

                        @include('job_requirements.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection