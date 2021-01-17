@extends('main')

@section('title', 'Tambah Model Kompetensi')

@section('content')
<section class="content-header">
        <h3>
            Tambah Model Kompetensi <br>  
        </h3>

    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-success">
            <div class="card shadow mb-4">
                <div class="card-body">
                    {!! Form::open(['route' => 'competencyModels.store']) !!}

                        @include('competency__models.fields')

                    {!! Form::close() !!}
                    </div>
            </div>
        </div>
    </div>
@endsection
