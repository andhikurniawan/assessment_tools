@extends('main')

@section('title', 'Detail Pelatihan/Sertifikasi Karyawan')

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
            <a href="{{ url()->previous() }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Detail Data Pelatihan/Sertifikasi</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{url('track-record/training-verification/'.$track_training->id)}}" method="post">
                @method("PUT")
                @csrf
                <div class="form-group">
                    <label for="training_name">Nama Pelatihan</label>
                    <input type="text" name="training_name" id="training_name" class="form-control"
                        value="{{ $track_training->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="host">Nama Pelaksana</label>
                    <input type="text" name="host" id="host" class="form-control"
                        value="{{  $track_training->host }}" disabled>
                </div>
                <div class="form-group">
                    <label for="duration">Durasi Pelatihan</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="number" name="duration" id="duration"
                                class="form-control"
                                value="{{ $track_training->duration }}" disabled>
                        </div>
                        <div class="col form-control-plaintext">
                            Hari
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_date">Tanggal Mulai</label>
                    <input type="text" name="start_date" id="start_date"
                        class="date form-control"
                        value="{{ $track_training->start_date }}" disabled >
                </div>
                <div class="form-group">
                    <label for="end_date">Tanggal Selesai</label>
                    <input type="text" name="end_date" id="end_date"
                        class="date form-control "
                        value="{{ $track_training->end_date }}" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Pelatihan</label>
                    <textarea name="description" class="form-control" rows="5" disabled
                        >{{ $track_training->description }}</textarea>
                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="form-group">
                            <label for="certificate">Bukti Sertifikat</label>
                            <input type="text" name="certificate" id="certificate" class="form-control"
                                value="{{ $track_training->certificate }}" disabled>
                        </div>
                    </div>
                    <div class="col-xs-1" style="padding-top: 1%">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Lihat
                          </button>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="link">Link Pelatihan</label>
                            <input type="url" name="link" id="link" class="form-control"
                                value="{{ $track_training->link }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reason_associated_work">Keterkaitan Dengan Pekerjaan</label>
                    <textarea name="reason_associated_work" class="form-control" rows="5" disabled
                        >{{ $track_training->reason_associated_work }}</textarea>
                </div> 

                @if (session('permission') != "user" && $track_training->status == "Menunggu")
                <div class="form-group">
                    <label for="verification">Verifikasi Data Pelatihan / Sertifikasi ?</label>
                    <select class="form-control" id="verification" name="verification">
                        <option value="Verifikasi" selected>Verifikasi</option>
                        <option value="Tolak">Tolak</option>
                    </select>
                </div>
                <div class="form-group d-none" id="verificationDiv">
                    <label for="reason_rejected">Alasan Ditolak</label>
                    <textarea name="reason_rejected" class="form-control @error('reason_rejected') is-invalid @enderror" rows="5"
                        placeholder="Isikan Alasan Anda Mengapa Data ini Ditolak">{{ old('reason_rejected', $track_training->reason_rejected)}}</textarea>
                        @error('reason_rejected')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="user_id" value="{{$track_training->user_id}}">
                @endif 

            </form>
        </div>
    </div>
      <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sertifikat Pelatihan Karyawan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="{{url('/uploaded_file/'.$track_training->certificate)}}" class="img-fluid" alt="Sertifikat Karyawan">
      </div>
    </div>
  </div>


@endsection

@section('script')

    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            $('#verification').change(function(){
                var status = $('#verification').val();
                if(status == "Tolak"){
                    $('#verificationDiv').removeClass("d-none");
                } else {
                    $('#verificationDiv').addClass("d-none");
                }
            });

        });

    </script>

@endsection
