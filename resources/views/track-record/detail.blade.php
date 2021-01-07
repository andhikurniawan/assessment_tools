@extends('main')

@section('title', 'Detail Karyawan')

@section('TrackRecord', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url('track-record') }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Detail Karyawan</h1>
        </div>

    </div>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

        <!-- Employee Profile -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-sm-auto">
                        <img class="img-profile rounded-circle" style="height: 130px; width: 130px"  src="{{asset('/style/img/profile-user.png')}}" alt="Foto Karyawan">
                    </div>
                    <div class="col ">
                        <div class="row">
                            <div class="col ">
                                <h1 style="color: black">{{ $employee->name}}</h1>
                                <p style="color: black"><span class="iconify" data-inline="false" data-icon="ic:baseline-email" style="font-size: 40px;"></span> {{ $employee->email}}</p>
                                <p style="color: black"><span class="iconify" data-inline="false" data-icon="bx:bxs-id-card" style="font-size: 40px;"></span> {{ $employee->employee_id}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Daftar Pelatihan / Sertifikasi -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pelatihan dan Sertifikasi Yang Pernah Diikuti</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pelatihan / Sertifikasi</th>
                            <th>Pelaksana</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($track_training as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->host}}</td>
                            <td>
                                @switch($item->status)
                                @case("Terverifikasi")
                                <div class="setuju">{{ $item->status }}</div>
                                @break
                                @case("Menunggu")
                                <div class="menunggu">{{ $item->status }}</div>
                                @break
                                @case("Ditolak")
                                <div class="ditolak">{{ $item->status }}</div>
                                @break
                                @default
                                <div class="selesai">{{ $item->status }}</div>
                            @endswitch    
                            </td>
                            <td class="text-center"><a href="{{ url('track-record/training/'.$item->id)}}" class="btn btn-primary">Lihat</a></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>

    <!-- Daftar Project -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Project Yang Pernah Diikuti</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>Platform</th>
                            <th>Posisi</th>
                            <th>Tanggal Mulai</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($track_project as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->platform }}</td>
                                <td>{{ $item->position }}</td>
                                <td>{{ $item->start_date }}</td>
                                <td>
                                    @switch($item->status)
                                @case("Terverifikasi")
                                <div class="setuju">{{ $item->status }}</div>
                                @break
                                @case("Sedang Berlangsung")
                                <div class="menunggu">{{ $item->status }}</div>
                                @break
                                @case("Gagal")
                                <div class="ditolak">{{ $item->status }}</div>
                                @break
                                @default
                                <div class="selesai">{{ $item->status }}</div>
                            @endswitch    </td>
                                <td><a href="{{ url('track-record/project/'.$item->id)}}" class="btn btn-primary">Detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    
    <!-- Daftar Riwayat Assessment -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Assessment</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Assessment</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assessment_result as $item)

                        <tr>
                            <td>{{ $item->assessment_name }}</td>
                            <td>{{ $item->start_date }}</td>
                            <td>{{ $item->end_date }}</td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dataTable').DataTable();
            // var data = table;
            // var table = $('#dataTable').DataTable();
            // var data = table.column(0).data().sort().reverse();
        });

    </script>
@endsection
