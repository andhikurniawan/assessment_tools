@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="box box-success">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('competency__models.show_fields')
                    <a href="{{ route('competencies.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
