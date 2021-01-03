@extends('main')

@section('title', 'Pilih Karyawan')

@section('TrainingRecommendation', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url('training/recommendation') }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Pilih Karyawan</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Karyawan dari Hasil Assessment</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>Assessment</th>
                            <th class="text-center">Detail Hasil Assessment</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assessment_result as $item)

                            <tr>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->assessment_name }}</td>
                                <td class="text-center"><a href="#" class="btn btn-primary">Lihat Detail</a></td>
                                <td class="text-center"><a href="#" data-toggle="modal"
                                        data-target="#addTrainingAssessmentModal" class="btn btn-success">Ajukan Rekomendasi
                                        Pelatihan</a></td>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Karyawan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
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
                                <td class="text-center"><a href="#" data-toggle="modal" data-target="#addTrainingAdminModal"
                                        class="btn btn-success">Ajukan Rekomendasi Pelatihan</a></td>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambahkan Training Modal-->
    <div class="modal fade" id="addTrainingAssessmentModal" tabindex="-1" role="dialog" aria-labelledby="addTrainingAssessmentModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Rekomendasi Pelatihan Dari Hasil Assessment</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <h4>Nama Pelatihan</h4>
                                <input type="text" name="training_name" class="form-control"
                                    placeholder="Tuliskan Nama Pelatihan..">
                                <br>
                                <h4>Link Pelatihan</h4>
                                <input type="text" name="training_link" class="form-control"
                                    placeholder="Tuliskan Link Pelatihan..">
                            </div>
                            <div class="col">
                                <h4>Pelaksana Pelatihan</h4>
                                <input type="text" name="training_host" class="form-control"
                                    placeholder="Tuliskan Pelaksana Pelatihan..">
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <h6>Tanggal Mulai</h6>
                                        <input type="text" name="start_date" class="date form-control"
                                            placeholder="YYYY-MM-DD">
                                    </div>
                                    <div class="col">
                                        <h6>Tanggal Berakhir</h6>
                                        <input type="text" name="end_date" class="date form-control"
                                            placeholder="YYYY-MM-DD">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary swal" href="#">Ajukan dan Kirim Email Kepada Karyawan</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Tambahkan Training Modal-->
    <div class="modal fade" id="addTrainingAdminModal" tabindex="-1" role="dialog" aria-labelledby="addTrainingAdminModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Rekomendasi Pelatihan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <h4>Nama Pelatihan</h4>
                                <input type="text" name="training_name" class="form-control"
                                    placeholder="Tuliskan Nama Pelatihan..">
                                <br>
                                <h4>Link Pelatihan</h4>
                                <input type="text" name="training_link" class="form-control"
                                    placeholder="Tuliskan Link Pelatihan..">
                            </div>
                            <div class="col">
                                <h4>Pelaksana Pelatihan</h4>
                                <input type="text" name="training_host" class="form-control"
                                    placeholder="Tuliskan Pelaksana Pelatihan..">
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <h6>Tanggal Mulai</h6>
                                        <input type="text" name="start_date" class="date form-control"
                                            placeholder="YYYY-MM-DD">
                                    </div>
                                    <div class="col">
                                        <h6>Tanggal Berakhir</h6>
                                        <input type="text" name="end_date" class="date form-control"
                                            placeholder="YYYY-MM-DD">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary swal" href="#">Ajukan dan Kirim Email Kepada Karyawan</a>
                    </div>
                </form>
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
            $('.dataTable').DataTable();
            // var data = table;
            // var table = $('#dataTable').DataTable();
            // var data = table.column(0).data().sort().reverse();
        });

    </script>

    <!-- Datepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $('.date').datepicker({
            format: 'yyyy-mm-dd'
        });

    </script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('style/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $('.swal').on('click', function() {
            Swal.fire(
                'Berhasil Dikirim!',
                'Email berhasil dikirim kepada karyawan bersangkutan!',
                'success'
            ).then((result) => {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            })
            $('#addTrainingModal').modal('toggle');

        })

    </script>
@endsection
