@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gap  Analysis
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($gapAnalysis, ['route' => ['gapAnalyses.update', $gapAnalysis->id], 'method' => 'patch']) !!}

                        @include('gap__analyses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection