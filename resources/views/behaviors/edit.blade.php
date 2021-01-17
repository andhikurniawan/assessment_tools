@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Behavior
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($behavior, ['route' => ['behaviors.update', $behavior->id], 'method' => 'patch']) !!}

                        @include('behaviors.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection