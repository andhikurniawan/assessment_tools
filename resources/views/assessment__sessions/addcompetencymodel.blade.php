@extends('layouts.app')

@section('content')
<div class="block">
                <div class="block-header block-header-default">
                    <h4 class="block-title">Add Competency Model</h4>
                </div>
                <div class="block-content">
                    <form method="POST" action="">
                    @csrf
                        <div class="form-group col-sm-12">
                        {!! Form::label('competency_models_id', 'Competency Model') !!}
                        {!! Form::select('competency_models_id[]', $items, null, ['class' => array('form-control','select2-multiple'), 'multiple' => true]) !!}
                        </div>
                        <div class="form-group col-sm-6">
                        {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </form>
                </div>
            </div>
@endsection