@extends('main')

@section('title', 'Training Recommendation')

@section('TrainingRecommendation', 'active')

@section('user', 'hidden')
@section('superadmin', 'hidden')            
@section('admin', 'hidden')            
@section('admin_pm', 'hidden')            
@section('admin_ot', 'hidden')   

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Training Recommendation</h1>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Training Recommendation -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Rekomendasi Pelatihan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pelatihan</th>
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
                                    <a href="{{ url('training/recommendation/details/'. $item->training_rec_id)}}" class="btn btn-primary tr-{{$item->status}}">Detail</a>                               
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

    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection
