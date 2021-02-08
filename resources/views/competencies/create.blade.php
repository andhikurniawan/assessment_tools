@extends('main')

@section('title', 'Tambah Kompetensi')
@section('kompetensi', 'active')
@switch(session('permission'))
    @case('admin_pm')      
        @section('superadmin', 'hidden')     
        @section('admin', 'hidden')            
        @section('admin_tnd', 'hidden')            
        @section('admin_ap', 'hidden')            
        @section('admin_ot', 'hidden')            
        @break
    @case('admin')
        @section('superadmin', 'hidden')                
            @break
    @default

@endswitch

@section('content')
    <section class="content-header">
        <h3>
        Tambah Kompetensi
        </h3>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-success">
            <div class="card shadow mb-4">
                <div class="card-body">
                    {!! Form::open(['route' => 'competencies.store']) !!}

                        @include('competencies.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
