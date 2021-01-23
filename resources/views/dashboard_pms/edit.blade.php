@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Dashboard Pm
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($dashboardPm, ['route' => ['dashboardPms.update', $dashboardPm->id], 'method' => 'patch']) !!}

                        @include('dashboard_pms.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection