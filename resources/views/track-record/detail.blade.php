@extends('main')

@section('title', 'Detail Karyawan')

@section('TrackRecord', 'active')
@switch(session('permission'))
    @case('user')
        @section('user', 'hidden')
        @section('superadmin', 'hidden')            
        @section('admin', 'hidden')            
        @section('admin_pm', 'hidden')            
        @section('admin_ot', 'hidden')                   
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

                    @if (session('permission') == 'user')
                        <h1 class="d-inline h3 text-gray-800">Track Record</h1>

                    @else
                        <a href="{{ url('track-record') }}" class="d-sm-inline text-decoration-none text-muted">
                            <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
                        </a>
                        <h1 class="d-inline h3 text-gray-800">Detail Karyawan</h1>
                    @endif

                </div>
            </div>


            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Employee Profile -->
            <div class="row">
            <div class="col">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-sm-auto">
                                    <img class="img-profile rounded-circle" style="height: 130px; width: 130px"
                                        src="{{ asset('/style/img/profile-user.png') }}" alt="Foto Karyawan">
                                </div>
                                <div class="col ">
                                    <div class="row">
                                        <div class="col ">
                                            <h1 style="color: black">{{ $employee->name }}</h1>
                                            <p style="color: black"><span class="iconify" data-inline="false"
                                                    data-icon="ic:baseline-email" style="font-size: 40px;"></span>
                                                {{ $employee->email }}
                                            </p>
                                            <p style="color: black"><span class="iconify" data-inline="false"
                                                    data-icon="bx:bxs-id-card" style="font-size: 40px;"></span>
                                                {{ $employee->employee_id }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('permission') == 'user')

                    <div class="col-sm-auto">
                        <!-- Track Record Period -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <h5>Waktu Periode Pengisian Track Record</h5>
                                <h6>Tanggal Mulai : <p class="d-inline"><b id="startDate">{{ $period->start_date }}</b></p>
                                </h6>
                                <h6>Tanggal Selesai : <p class="d-inline"><b id="endDate">{{ $period->end_date }}</b></p>
                                </h6>

                                <a class="btn btn-primary d-block inputPeriod" href="{{ url('track-record/insertTraining') }}"
                                    style="margin-bottom: 2%"><b>Tambahkan Data Pelatihan</b></a>
                                <a class="btn btn-success d-block inputPeriod"
                                    href="{{ url('track-record/insertProject') }}"><b>Tambah Data Project</b></a>
                            </div>
                        </div>
                    </div>
                @endif
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
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->host }}</td>
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
                                        <td class="text-center"><a href="{{ url('track-record/training/' . $item->id) }}"
                                                class="btn btn-primary tr-{{$item->status}}">Lihat</a>
                                            @if (session('permission') == 'user')
                                                @if ($item->status == 'Menunggu' || $item->status == "Ditolak")
                                                    <a href="{{ url('track-record/training/edit/' . $item->id) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <form action="{{ url('track-record/training/delete/' . $item->id) }}"
                                                        method="post" class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin untuk menghapus data ini?')">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger">Hapus</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
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
                                    <th>Nama Project</th>
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
                                            @endswitch
                                        </td>
                                        <td class="text-center"><a href="{{ url('track-record/project/' . $item->id) }}"
                                                class="btn btn-primary">Detail</a>
                                            @if (session('permission') == 'user')
                                                @if ($item->status == 'Sedang Berlangsung')
                                                    <a href="{{ url('track-record/project/edit/' . $item->id) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <form action="{{ url('track-record/project/delete/' . $item->id) }}"
                                                        method="post" class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin untuk menghapus data ini?')">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger">Hapus</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
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
                    <form method="post" action="{{ route('result/detail/laporan') }}">
                        <input type="hidden" name="id" id="id">
                        @if (session('permission') == "user")
                            <input type="hidden" name="track_user" value="user">
                        @endif
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
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
                                        <td class="text-center"><button id="{{ $item->id . '-' . $item->session_id }}"  class="btn btn-primary btn-submit">Detail</button></td>
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

            <!-- Page level plugins -->
            <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

            <!-- Page level custom scripts -->
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.dataTable').DataTable({
                        order: [[2, 'asc']]
                    });
                    // var data = table;
                    // var table = $('#dataTable').DataTable();
                    // var data = table.column(0).data().sort().reverse();
                });

            </script>

            <script>
                jQuery(document).ready(function() {
                    var start_date = "{{ $period->start_date }}";
                    var end_date = "{{ $period->end_date }}";
                    var options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    if (start_date != "Belum ditentukan" && end_date != "Belum ditentukan") {
                        var start_millis = Date.parse(start_date + " 00:00:00");
                        var end_millis = Date.parse(end_date + " 23:59:59");
                        var now_millis = Date.now();
                        var dateStart = new Date(start_date);
                        var dateEnd = new Date(end_date);
                        var longStartDate = dateStart.toLocaleDateString("id-ID", options);
                        var longEndDate = dateEnd.toLocaleDateString("id-ID", options);
                        $('#startDate').text(longStartDate);
                        $('#endDate').text(longEndDate);
                        if (now_millis >= start_millis && now_millis <= end_millis) {
                            $('.inputPeriod').removeClass("disabled");
                        } else {
                            $('.inputPeriod').addClass("disabled");
                        }

                    }
                });

            </script>
                <script type="text/javascript">

                    $(document).ready(function(){
                
                        $(document).on("click", "button.btn-submit", function(){
                
                            $("#id").val(this.id);
                
                        });
                
                    });
                
                </script>
        @endsection
