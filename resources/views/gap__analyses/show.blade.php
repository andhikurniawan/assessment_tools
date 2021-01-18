@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gap  Analysis
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('gap__analyses.show_fields')
                    <a href="{{ route('gapAnalyses.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
