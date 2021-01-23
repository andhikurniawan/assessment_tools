@extends('main')

@section('title', 'Tambah Model Kompetensi')
@section('ModelKompetensi', 'active')
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
        <h4>
            Tambah Model Kompetensi <br>  
        </h4>

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

@section('script')     
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Pilih Kompetensi",
                closeOnSelect: false
            });
        });
    </script>
@endsection