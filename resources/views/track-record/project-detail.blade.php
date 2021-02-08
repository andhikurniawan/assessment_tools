@extends('main')

@section('title', 'Detail Project Karyawan')

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
            <h1 class="d-inline h3 text-gray-800">Detail Data Project</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
                <div class="form-group">
                    <label for="project_name">Nama Project</label>
                    <input type="text" name="project_name" id="project_name" class="form-control"
                        value="{{ $track_project->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="platform">Platform Output Project</label>
                    <input type="text" name="platform" id="platform" class="form-control"
                        value="{{  $track_project->platform }}" disabled>
                </div>
                <div class="form-group">
                    <label for="position">Posisi Dalam Project</label>
                    <input type="text" name="position" id="position" class="form-control"
                        value="{{  $track_project->position }}" disabled>
                </div>
                <div class="form-group">
                    <label for="status">Status Project</label>
                    <input type="text" name="status" id="status" class="form-control"
                        value="{{  $track_project->status }}" disabled>
                </div>
                <div class="form-group">
                    <label for="start_date">Tanggal Mulai</label>
                    <input type="text" name="start_date" id="start_date"
                        class="date form-control"
                        value="{{ $track_project->start_date }}" disabled >
                </div>

                @if ($track_project->status == "Selesai" || $track_project->status == "Gagal")
                    <div class="form-group">
                    <label for="end_date">Tanggal Selesai</label>
                    <input type="text" name="end_date" id="end_date"
                        class="date form-control "
                        value="{{ $track_project->end_date }}" disabled>
                </div>
                @endif
                
                <div class="form-group">
                    <label for="description">Deskripsi Project</label>
                    <textarea name="description" class="form-control" rows="5" disabled
                        >{{ $track_project->description }}</textarea>
                </div>

                @if ($track_project->status == "Gagal")
                    
                <div class="form-group">
                    <label for="reason_failed">Kenapa gagal?</label>
                    <textarea name="reason_failed" class="form-control" rows="5" disabled
                        >{{ $track_project->reason_failed }}</textarea>
                </div>

                @endif

                @if ($track_project->status == "Selesai")
                <div class="form-group">
                    <label for="time_performance">Performa Waktu dalam Project</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="time_performance" id="overTimeOption" value="Over" {{$track_project->time_performance == "Over" ? "checked" : "disabled"}}>
                        <label class="form-check-label" for="overTimeOption">
                          Selesai lebih lama dari jadwal
                        </label>
                      </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="time_performance" id="nomarlTimeOption" value="Normal" {{$track_project->time_performance == "Normal" ? "checked" : "disabled"}}>
                        <label class="form-check-label" for="nomarlTimeOption">
                          Selesai sesuai jadwal
                        </label>
                      </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="time_performance" id="lessTimeOption" value="Less" {{$track_project->time_performance == "Less" ? "checked" : "disabled"}}>
                        <label class="form-check-label" for="lessTimeOption">
                          Selesai lebih cepat dari jadwal
                        </label>
                      </div>
                </div>

                <div class="form-group">
                    <label for="cost_performance">Performa Biaya dalam Project</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cost_performance" id="overCostOption" value="Over" {{$track_project->cost_performance == "Over" ? "checked" : "disabled"}}>
                        <label class="form-check-label" for="overCostOption">
                          Selesai lebih dari perkiraan biaya awal
                        </label>
                      </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cost_performance" id="normalCostOption" value="Normal" {{$track_project->cost_performance == "Normal" ? "checked" : "disabled"}}>
                        <label class="form-check-label" for="normalCostOption">
                          Selesai sesuai perkiraan
                        </label>
                      </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cost_performance" id="lessCostOption" value="Less" {{$track_project->cost_performance == "Less" ? "checked" : "disabled"}}>
                        <label class="form-check-label" for="lessCostOption">
                          Selesai kurang dari perkiraan biaya awal
                        </label>
                      </div>
                </div>

                <div class="form-group">
                    <label for="quality_performance">Performa Kualitas dalam Project</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="quality_performance" id="overQualityOption" value="Over" {{$track_project->quality_performance == "Over" ? "checked" : "disabled"}}>
                        <label class="form-check-label" for="overQualityOption">
                          Diatas harapan
                        </label>
                      </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="quality_performance" id="normalQualityOption" value="Normal" {{$track_project->quality_performance == "Normal" ? "checked" : "disabled"}}>
                        <label class="form-check-label" for="normalQualityOption">
                          Sesuai harapan
                        </label>
                      </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="quality_performance" id="lessQualityOption" value="Less" {{$track_project->quality_performance == "Less" ? "checked" : "disabled"}}>
                        <label class="form-check-label" for="lessQualityOption">
                          Dibawah harapan
                        </label>
                      </div>
                </div>
                @endif
        </div>
    </div>
      <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sertifikat Pelatihan Karyawan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="" alt="Sertifikat Karyawan">
      </div>
    </div>
  </div>


@endsection

@section('script')

    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

@endsection
