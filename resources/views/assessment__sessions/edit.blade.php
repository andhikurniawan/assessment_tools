@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Assessment  Session
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($assessmentSession, ['route' => ['assessmentSessions.update', $assessmentSession->id], 'method' => 'patch']) !!}

                        @include('assessment__sessions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection