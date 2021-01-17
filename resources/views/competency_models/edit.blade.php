@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Competency Models
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($competencyModels, ['route' => ['competencyModel.update', $competencyModels->id], 'method' => 'patch']) !!}

                        @include('competency_models.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection