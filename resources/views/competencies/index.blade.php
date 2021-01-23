@extends('main')

@section('title', 'Daftar Kompetensi')

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
@section('css_after')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endsection

@section('content')

<div class="block">
        <div class="block-content">
            <div class="row">
                <div class="col-md-12">
                    <h3>Kelola Seluruh Kompetensi </h3>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-3">
                    <h3 class="h5 text-muted mb-0">Perusahaan : </h3>
                </div>
                <div class="col-md-4 float-left" >
                    <select class="form-control" onchange="filterCompetencyGroup(this.value)" id="companyName" name="companyName">
                       
                        <option value="0" >Seluruh Perusahaan</option>
                        @foreach($companies as $company)
                        <option value="{{$company->id}}" {{ $selected_company==$company->id?"Selected": "" }} >{{ $company->name }}</option>
                        @endforeach
                      
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <h3 class="h5 text-muted mb-0">Grup Kompetensi : </h3>
                </div>
                <div class="col-md-4 float-left" >
                    <select class="form-control" onchange="filterCompetency(this.value)">
                        <option id="competencyGroup" value="0">Select All</option>
                        @foreach($competencyGroups as $competencyGroup)
                            <option id="competencyGroup" value="{{ $competencyGroup->id }}" {{ $selected_competency_group == $competencyGroup->id?"selected":""  }}> {{$competencyGroup->name}} </option>
                        @endforeach
                    </select>
                   
                </div>
                <div class="col-md-5">
                    <div class="text-right">
            <a href="{{ route('competencies.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambah Kompetensi Baru</a>
             </div>
                </div>
            </div>

            <br>
     <!-- Daftar Kompetensi-->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kompetensi</h6>
        </div>
        <div class="card-body">
        @include('competencies.table')
        </div>
    </div>
            
@endsection

@section('js_after')
    <script>
        var x = "";
        function filterCompetencyGroup(id){
            x = id;
            if(id != 0){
                var url = "{{ action("CompetencyController@filterCompetencyGroup", ":company") }}"
                url = url.replace(':company', id);
            }else{
                var url = "{{ action("CompetencyController@index") }}"
            }
            window.location.href = url;
        }
        function filterCompetency(id){
            var company_id = document.getElementById("companyName").value;
            if (id != 0) {
                var url = "{{ action("CompetencyController@filtering", [":company", ":competencyGroup"]) }}"
                url = url.replace(':company', company_id);
                url = url.replace(':competencyGroup', id);
            }
            // console.log(url);
            window.location.href = url;
        }
    </script>

    
@section('script')
 <!-- Page level plugins -->
 <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>

    @endsection