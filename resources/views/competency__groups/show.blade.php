@extends('layouts.app')

@section('GrupKompetensi', 'active')
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
        <h1>
            Competency Group
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('competency__groups.show_fields')
                    <a href="{{ route('competencyGroups.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
