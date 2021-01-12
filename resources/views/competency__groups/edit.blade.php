@extends('layouts.app')

@section('content')
    <section class="content-header">
    <div class ="container">
        <h3>
            Edit Grup Kompetensi <br>  
        </h3>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="form-group col-sm-12">
       <div class="box box-success">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($competencyGroup, ['route' => ['competencyGroups.update', $competencyGroup->id], 'method' => 'patch']) !!}

                        @include('competency__groups.fields')

                   {!! Form::close() !!}
                   </div>
            </div>
        </div>
        </div>
    </div>
    </div>
@endsection