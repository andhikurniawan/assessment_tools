@extends('layouts.app')

@section('content')
    <section class="content-header">
    <div class ="container">
        <h3>
            Edit Key Behaviour <br>  
        </h3>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="form-group col-sm-12">
       <div class="box box-success">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($keyBehaviour, ['route' => ['keyBehaviours.update', $keyBehaviour->id], 'method' => 'patch']) !!}

                        @include('key__behaviours.fields')

                   {!! Form::close() !!}
                   </div>
            </div>
        </div>
        </div>
    </div>
    </div>
@endsection