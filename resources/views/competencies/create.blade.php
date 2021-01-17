@extends('main')

@section('title', 'Tambah Kompetensi')

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
