@extends('main')

@section('title', 'Edit Kompetensi')

@section('content')
    <section class="content-header">
        <h3>
            Edit Kompetensi
        </h3>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-success">
       <div class="card shadow mb-4">
                <div class="card-body">
                   {!! Form::model($competency, ['route' => ['competencies.update', $competency->id], 'method' => 'patch']) !!}

                        @include('competencies.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection