@extends('main')

@section('title', 'Tambah Grup Kompetensi')

@section('content')
    <section class="content-header">
  
        <h3>
            Tambah Grup Kompetensi <br>  
        </h3>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
       
        <div class="box box-success">
        <div class="card shadow mb-4">
        <div class="card-body">
                    {!! Form::open(['route' => 'competencyGroups.store']) !!}

                        @include('competency__groups.fields')

                    {!! Form::close() !!}
                    </div>
            </div>
        </div>
    </div>
  
@endsection
