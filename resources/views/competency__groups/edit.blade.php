@extends('main')

@section('title', 'Edit Grup Kompetensi')

@section('content')
    <section class="content-header">
        <h3>
            Edit Grup Kompetensi <br>  
        </h3>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-success">
       <div class="card shadow mb-4">
       <div class="card-body">
                   {!! Form::model($competencyGroup, ['route' => ['competencyGroups.update', $competencyGroup->id], 'method' => 'patch']) !!}

                        @include('competency__groups.fields')

                   {!! Form::close() !!}
                 
        </div>
        </div>
    </div>
    </div>
@endsection