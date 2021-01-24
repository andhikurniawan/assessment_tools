@extends('main')

@section('title', 'Track Record')

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
                <h1 class="h3 mb-0 text-gray-800">Track Record</h1>

            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <!-- Track Record Period -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Waktu Periode Pengisian Track Record</h6>
                </div>
                <div class="card-body">
                    <h1 class=" h4 text-gray-800">Perusahaan</h1>
                    <select name="company" id="company" class="form-control">
                        @if (Auth::user()->company_id != null)
                            <option value="{{ $company->first()->id }}" selected>{{ $company->first()->name }}</option>
                    </select>
                    <br>
                    <h4>Tanggal Mulai</h4>
                    <p><b id="startDate">{{ $period->start_date }}</b></p>
                    <h4>Tanggal Selesai</h4>
                    <p><b id="endDate">{{ $period->end_date }}</b></p>
                @else
                    <option value="">Pilih Perusahaan</option>
                    @foreach ($company as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                    </select>
                    <br>
                    <h4>Tanggal Mulai</h4>
                    <p><b id="startDate">Pilih Perusahaan</b></p>
                    <h4>Tanggal Selesai</h4>
                    <p><b id="endDate">Pilih Perusahaan</b></p>
                    @endif



                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Ubah
                    </button>
                </div>
            </div>

            <!-- List Employees -->
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
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee as $item)

                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center"><a href="{{ url('track-record/employee/' . $item->user_id) }}"
                                                class="btn btn-primary">Detail</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Periode Input Track Record</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('track-record/updatePeriod') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col text-center">
                                        <a class="btn btn-primary" name="daterange" href="#">Pilih Tanggal</a>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <h5>Tanggal Mulai</h5>
                                        <input type="text" name="start_date" id="startDateModal">
                                    </div>
                                    <div class="col">
                                        <h5>Tanggal Berakhir</h5>
                                        <input type="text" name="end_date" id="endDateModal">
                                    </div>
                                    <input type="text" name="company_modal" id="companyModal" hidden>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection

        @section('script')

            <!-- Page level plugins -->
            <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

            <!-- Page level custom scripts -->

            <!-- Page level custom scripts -->
            <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>

            {{-- <script type="text/javascript"
                src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
            <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
            <script>
                $(function() {
                    $('a[name="daterange"]').daterangepicker({
                        opens: 'center'
                    }, function(start, end, label) {
                        $('input[name="start_date"]').val(start.format('YYYY-MM-DD'));
                        $('input[name="end_date"]').val(end.format('YYYY-MM-DD'));
                        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                            .format('YYYY-MM-DD'));
                    });
                });

            </script>
            <script>
                var auth_id = "{{ Auth::user()->company_id }}";
                console.log(auth_id);
                    if (auth_id != "null") {
                        var start_date = "{{ $period->start_date }}";
                        var end_date = "{{ $period->end_date }}";
                        var options = {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        if (start_date != "Belum ditentukan" && end_date != "Belum ditentukan") {
                            var dateStart = new Date(start_date);
                            var dateEnd = new Date(end_date);
                            var longStartDate = dateStart.toLocaleDateString("id-ID", options);
                            var longEndDate = dateEnd.toLocaleDateString("id-ID", options);
                            $('#startDate').text(longStartDate);
                            $('#startDateModal').val(start_date);
                            $('#endDate').text(longEndDate);
                            $('#endDateModal').val(end_date);
                            $('#companyModal').val($('#company').val());
                        }
                    }


            </script>
            <script>
                $('#company').change(function() {
                    if ($(this).val() == '') {
                        $('#startDate').val("Belum Ditentukan");
                        $('#endDate').val("Belum Ditentukan");
                    } else {
                        var id = $(this).val();
                        var options = {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        var url = '{{ route("getPeriodCompany", ":id") }}';
                        url = url.replace(':id', id);
                        $.ajax({
                            url: url,
                            type: 'get',
                            data: {},
                            success: function(data) {
                                if (data.data != null) {
                                    var dateStart = new Date(data.data.start_date);
                                    var dateEnd = new Date(data.data.end_date);
                                    var longStartDate = dateStart.toLocaleDateString("id-ID", options);
                                    var longEndDate = dateEnd.toLocaleDateString("id-ID", options);
                                    $('#startDate').text(longStartDate);
                                    $('#startDateModal').val(data.data.start_date);
                                    $('#endDate').text(longEndDate);
                                    $('#endDateModal').val(data.data.end_date);
                                    $('#companyModal').val($('#company').val());
                                } else {
                                    $('#startDate').text("Belum Ditentukan");
                                    $('#endDate').text("Belum Ditentukan");
                                    $('#companyModal').val($('#company').val());
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {}
                        });
                    }
                });

            </script>
        @endsection
