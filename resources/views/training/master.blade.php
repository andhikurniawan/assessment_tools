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
            <a href="{{ url('training/recommendation') }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Master Data Pelatihan</h1>
        </div>
        <div class="text-right">
            <a href="{{ url('training/master/create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data Pelatihan</a>
        </div>

    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pelatihan</h6>
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
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->host }}</td>
                                <td>{{ $item->duration }}</td>
                                <td>{{ $item->start_date }} </td>
                                <td>{{ $item->end_date }} </td>
                                <td class="text-center">
                                    <a href="{{ url('training/'. $item->id)}}" class="btn btn-primary">Detail</a>
                                    <a href="{{ url('training/'. $item->id . '/edit')}}" class="btn btn-warning">Edit</a>
                                    <form action="{{ url('training/'. $item->id)}}" method="post"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin untuk menghapus data ini?')"
                                        >
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger">Hapus</button>
                                    
                                    </form>
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
