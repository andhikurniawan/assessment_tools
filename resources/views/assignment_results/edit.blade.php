@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Assignment Result
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($assignmentResult, ['route' => ['assignmentResults.update', $assignmentResult->id], 'method' => 'patch']) !!}

                        @include('assignment_results.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection