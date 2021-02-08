@extends('main')

@section('title', 'Training Recommendation')

@section('TrainingRecommendation', 'active')
@switch(session('permission'))
    @case('user')
        @section('user', 'hidden')            
        @break
    @case('admin_tnd')
    @section('superadmin', 'hidden')            
    @section('admin', 'hidden')            
    @section('admin_pm', 'hidden')            
    @section('admin_ap', 'hidden')            
    @section('admin_ot', 'hidden')            
        @break
        @case('admin')
        @section('superadmin', 'hidden')                
            @break
    @default

@endswitch
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url('training/master') }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Detail Data Pelatihan</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body table-responsive text-center">
           <div class="row">
               <table class="table table-borderless">
                   <tbody>
                       <tr>
                           <th>Perusahaan</th>
                           <td>{{ $company->name}}</td>
                       </tr>
                       <tr>
                           <th>Nama Pelatihan</th>
                           <td>{{ $training->name}}</td>
                       </tr>
                       <tr>
                           <th>Nama Pelaksana</th>
                           <td>{{ $training->host}}</td>
                       </tr>
                       <tr>
                           <th>Durasi Pelatihan</th>
                           <td>{{ $training->duration}}</td>
                       </tr>
                       <tr>
                           <th>Tanggal Mulai Pelatihan</th>
                           <td>{{ $training->start_date}}</td>
                       </tr>
                       <tr>
                           <th>Tanggal Selesai Pelatihan</th>
                           <td>{{ $training->end_date}}</td>
                       </tr>
                       <tr>
                           <th>Deskripsi Pelatihan</th>
                           <td>{{ $training->description}}</td>
                       </tr>
                       <tr>
                           <th>Link Pelatihan</th>
                           <td>{{ $training->link}}</td>
                       </tr>
                   </tbody>
               </table>
           </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kompetensi yang Terkait</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training_competency as $item)
                            <tr>
                                <td class="text-center">{{ $item->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Datepicker -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $('.date').datepicker({
            format: 'yyyy-mm-dd'
        });

    </script>
@endsection
