@extends('main')

@section('title', 'Detail Kompetensi')

@section('content')
    <div class="content">
    <div class="card shadow mb-4">
                <div class="card-body">
                    @include('competencies.show_fields')
                    <a href="{{ route('competencies.index') }}" class="btn btn-danger">Back</a>
                </div>
           
        </div>
    </div>
@endsection
