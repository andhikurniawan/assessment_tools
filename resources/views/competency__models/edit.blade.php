@extends('main')

@section('title', 'Edit Model Kompetensi')

@section('content')
    <section class="content-header">
        <h3>
            Competency  Model
        </h3>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-success">
       <div class="card shadow mb-4">
       <div class="card-body">
                   {!! Form::model($competencyModel, ['route' => ['competencyModels.update', $competencyModel->id], 'method' => 'patch']) !!}

                        @include('competency__models.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection