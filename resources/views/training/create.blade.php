@extends('main')

@section('title', 'Pilih Karyawan')

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
            <h1 class="d-inline h3 text-gray-800">Pilih Karyawan</h1>
        </div>

    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Karyawan dari Hasil Assessment</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('result/detail/laporan') }}" method="post">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
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
                                <td class="text-center"><button id="{{ $item->id . '-' . $item->session_id }}"  class="btn btn-primary btn-submit">Lihat Detail</button></td>
                                <td class="text-center"><a href="#" data-toggle="modal" data-target-id = "{{ $item->id }}" data-target-type= "assessment"
                                        data-target="#addTrainingAssessmentModal" class="btn btn-success">Ajukan Rekomendasi
                                        Pelatihan</a></td>
                        @endforeach

                    </tbody>
                </table>
            </form>
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
                                <td class="text-center"><a href="#" data-toggle="modal" data-target-id = "{{ $item->user_id }}" data-target="#addTrainingAssessmentModal" data-target-type= "admin"
                                        class="btn btn-success">Ajukan Rekomendasi Pelatihan</a></td>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambahkan Training Modal dari hasil assessment-->
    <!-- tabindex = "-1" dihilangkan untuk select2 -->
    <div class="modal fade modalTraining" id="addTrainingAssessmentModal" role="dialog" aria-labelledby="addTrainingAssessmentModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Rekomendasi Pelatihan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ url('training/recommendation/add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col text-center">
                                <h4>Pilih Data Pelatihan</h4>
                                <select class="js-example-basic-single" name="trainingDropdown" id="trainingDropdown">
                                    <option></option>
                                    @foreach ($training as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <h4>Nama Pelatihan</h4>
                                <input type="text" name="training_name" class="form-control training_name" id="training_name"
                                    placeholder="Kolom terisi otomatis" disabled>
                                <br>
                                <h4>Link Pelatihan</h4>
                                <input type="text" name="training_link" class="form-control training_link"
                                placeholder="Kolom terisi otomatis" disabled>
                                <br>
                                <h4>Sifat Pelatihan</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="trainingType" id="optionalOption" value="Opsional" checked>
                                    <label class="form-check-label" for="optionalOption">
                                      Opsional
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="trainingType" id="requiredOption" value="Wajib">
                                    <label class="form-check-label" for="requiredOption">
                                      Wajib
                                    </label>
                                  </div>
                                  <br>
                                  <input type="text" name="userId" id="userId" class="d-none">
                            </div>

                            <div class="col">
                                <h4>Pelaksana Pelatihan</h4>
                                <input type="text" name="training_host" class="form-control training_host"
                                placeholder="Kolom terisi otomatis" disabled>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <h6>Tanggal Mulai</h6>
                                        <input type="text" name="start_date" class="date form-control training_start"
                                        placeholder="Kolom terisi otomatis" disabled>
                                    </div>
                                    <div class="col">
                                        <h6>Tanggal Berakhir</h6>
                                        <input type="text" name="end_date" class="date form-control training_end"
                                        placeholder="Kolom terisi otomatis" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="reasonDiv">
                            <div class="col">
                                <h4>Alasan Rekomendasi</h4>
                                <div class="form-group">
                                    <textarea name="reason" class="form-control" rows="5"
                                        placeholder="Masukkan Alasan Anda Dalam Merekomendasikan Pelatihan Kepada Karyawan Ini.."></textarea>
                                </div>
                                <input type="text" name="recommendedBy" id="recommendedBy" class="d-none">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ajukan Kepada Karyawan</button>
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
        <script>
            (function($) {
        $.fn.invisible = function() {
            return this.each(function() {
                $(this).css("visibility", "none");
            });
        };
        $.fn.visible = function() {
            return this.each(function() {
                $(this).css("visibility", "visible");
            });
        };
    }(jQuery));
        </script>
    <script>
$('.modalTraining').on('show.bs.modal', function(e) {
        userId = $(e.relatedTarget).data("target-id");
        type = $(e.relatedTarget).data("target-type");
    $("#userId").val(userId);
    if(type == "admin"){
        $("#reasonDiv").removeClass("d-none");
        $("#recommendedBy").val("Admin")
    } else {
        $("#reasonDiv").addClass("d-none");
        $("#recommendedBy").val("Hasil Assessment");
    }

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
            $('.modalTraining').modal('toggle');

        })

    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: "Pilih Pelatihan",
            allowClear: true
            // dropdownParent: $('#addTrainingAssessmentModal');
        });
    });    
    </script>
    
    <script>
        $('#trainingDropdown').change(function() {
            if ($(this).val() == ''){
                $('.training_name').val(null);
                        $('.training_host').val(null);
                        $('.training_link').val(null);
                        $('.training_start').val(null);
                        $('.training_end').val(null);
            } else {
            var id = $(this).val();
            var url = '{{ route("getTrainingDetails", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'get',
                data: {},
                success: function(data) {
                    if (data.success == true) {
                        $('.training_name').val(data.data.name);
                        $('.training_host').val(data.data.host);
                        $('.training_link').val(data.data.link);
                        $('.training_start').val(data.data.start_date);
                        $('.training_end').val(data.data.end_date);
                    } else {
                        alert('Data kosong');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });
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
