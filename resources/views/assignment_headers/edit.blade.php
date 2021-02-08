@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Assignment Header
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($assignmentHeader, ['route' => ['assignmentHeaders.update', $assignmentHeader->id], 'method' => 'patch']) !!}

                        @include('assignment_headers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection