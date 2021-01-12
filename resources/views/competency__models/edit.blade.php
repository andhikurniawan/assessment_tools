@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Competency  Model
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($competencyModel, ['route' => ['competencyModels.update', $competencyModel->id], 'method' => 'patch']) !!}

                        @include('competency__models.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection