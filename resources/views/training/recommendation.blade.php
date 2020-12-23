@extends('main')

@section('title', 'Training Recommendation')

@section('TrainingRecommendation', 'active')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Training Recommendation</h1>
        <a href="{{url('training/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Buat Rekomendasi Pelatihan</a>
    </div>

<!-- DataTales Example -->
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
                        <th>Tanggal Pelatihan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($training as $item)
                    <tr>
                    <td rowspan="2" class="align-middle">{{ $item->user->name}}</td>
                    <td>{{ $item->training_name}}</td>
                    <td>{{ $item->start_date}}</td>
                    <td rowspan="2" class="align-middle">{{ $item->training_status }} </td>
                    <td rowspan="2" class="align-middle"> Action button here </td>
                    </tr>
                    <tr>
                        <td class="text-muted">{{ $item->training_host }}</td>
                        <td>{{ $item->end_date}}</td>
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
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js')}}"></script>
@endsection