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
        <h1 class="h3 mb-0 text-gray-800">Training Recommendation</h1>
        <div class="text-right">
            <a href="{{ url('training/master') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Buat Master Pelatihan</a>
            <a href="{{ url('training/create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Buat Rekomendasi Pelatihan</a>
        </div>

    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Training Recommendation -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Karyawan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>Rekomendasi Pelatihan</th>
                            <th>Pelaksana</th>
                            <th>Durasi Pelatihan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training_emp as $item)
                            <tr>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->host }}</td>
                                <td>{{ $item->duration }} hari</td>
                                <td>{{ $item->start_date }}</td>
                                <td>{{ $item->end_date }}</td>
                                <td>
                                    @switch($item->status)
                                        @case("Disetujui")
                                        <div class="setuju">{{ $item->status }}</div>
                                        @break
                                        @case("Menunggu Respon")
                                        <div class="menunggu">{{ $item->status }}</div>
                                        @break
                                        @case("Ditolak")
                                        <div class="ditolak">{{ $item->status }}</div>
                                        @break
                                        @case("Sedang Berjalan")
                                        <div class="sedang_berjalan">{{ $item->status }}</div>
                                        @break
                                        @case("Selesai")
                                        <div class="selesai">{{ $item->status }}</div>
                                        @break
                                        @default
                                        <div class="selesai">{{ $item->status }}</div>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('training/recommendation/details/'. $item->training_rec_id)}}" class="btn btn-primary">Detail</a>
                                    @if ($item->status == "Menunggu Respon" || $item->status == "Wajib")
                                    <a href="{{ url('training/recommendation/edit/'. $item->training_rec_id)}}" class="btn btn-warning">Edit</a>                                        
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            var $status = $('.status').html();
            switch ($status) {
                case "Setuju":
                    $('.status').addClass("setuju");
                    break;
                case "Menunggu Respon":
                    $('.status').addClass("menunggu");
                    break;
                case "Ditolak":
                    $('.status').addClass("ditolak");
                    break;
                case "Selesai":
                    $('.status').addClass("selesai");
                    break;
                case "Sedang Berjalan":
                    $('.status').addClass("sedang_berjalan");
                    break;
                case "Dibatalkan":
                    $('.status').addClass("ditolak");
                    break;
                case "Wajib":
                    $('.status').addClass("ditolak");
                    break;
                default:
                    break;
            }
        });

    </script> --}}
    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection
