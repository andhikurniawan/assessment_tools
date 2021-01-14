@extends('main')

@section('title', 'Edit Data Project')

@section('TrackRecord', 'active')

@section('user', 'hidden')
@section('superadmin', 'hidden')            
@section('admin', 'hidden')            
@section('admin_pm', 'hidden')            
@section('admin_ot', 'hidden')   

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url()->previous() }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Edit Data Project</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('track-record/project/editProcess/'.$track_project->id) }}" method="post">
                @method("PUT")
                @csrf
                <div class="form-group">
                    <label for="project_name">Nama Project</label>
                    <input type="text" name="project_name" id="project_name" class="form-control" placeholder="Masukkan Nama Project.." value="{{ old('project_name', $track_project->name)}}">
                </div>
                <div class="form-group">
                    <label for="platform">Platform Output Project</label>
                    <input type="text" name="platform" id="platform" class="form-control" placeholder="Masukkan Platform Output Project.." value="{{ old('platform', $track_project->platform)}}">
                </div>
                <div class="form-group">
                    <label for="position">Posisi Dalam Project</label>
                    <input type="text" name="position" id="position" class="form-control" placeholder="Masukkan Posisi Anda dalam Project ini.." value="{{ old('position', $track_project->position)}}">
                </div>
                <div class="form-group">
                    <label for="status">Status Project</label>
                    <select class="form-control" id="status" name="status">
                        <option value="Sedang Berlangsung" {{ $track_project->status == "Sedang Berlangsung" ? "checked" : null}}>Sedang Berlangsung</option>
                        <option value="Selesai" {{ $track_project->status == "Selesai" ? "checked" : null}}>Selesai</option>
                        <option value="Gagal" {{ $track_project->status == "Gagal" ? "checked" : null}}>Gagal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start_date">Tanggal Mulai</label>
                    <input type="text" name="start_date" id="start_date" class="date form-control" placeholder="YYYY-MM-DD" value="{{ old('start_date', $track_project->start_date)}}">
                </div>
                <div class="form-group d-none" id="endDateDiv">
                    <label for="end_date">Tanggal Selesai</label>
                    <input type="text" name="end_date" id="end_date" class="date form-control" placeholder="YYYY-MM-DD" value="{{ old('end_date', $track_project->end_date)}}">
                </div>


                <div class="form-group">
                    <label for="description">Deskripsi Project</label>
                    <textarea name="description" class="form-control" rows="5"
                        placeholder="Masukkan Deskripsi Project..">{{ old('description', $track_project->description)}}</textarea>
                </div>

                <div class="form-group d-none" id="whyFailedDiv">
                    <label for="reason_failed">Kenapa gagal?</label>
                    <textarea name="reason_failed" class="form-control" rows="5"
                        placeholder="Alasan Project ini Gagal..">{{ old('reason_failed', $track_project->reason_failed)}}</textarea>
                </div>

                <div class="form-group d-none" id="timePerfDiv">
                    <label for="time_performance">Performa Waktu dalam Project</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="time_performance" id="overTimeOption"
                            value="Over" {{$track_project->time_performance == "Over" ? "checked" : null}}>
                        <label class="form-check-label" for="overTimeOption">
                            Selesai lebih lama dari jadwal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="time_performance" id="nomarlTimeOption"
                            value="Normal" {{$track_project->time_performance == "Normal" ? "checked" : null}}>
                        <label class="form-check-label" for="nomarlTimeOption">
                            Selesai sesuai jadwal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="time_performance" id="lessTimeOption"
                            value="Less" {{$track_project->time_performance == "Less" ? "checked" : null}}>
                        <label class="form-check-label" for="lessTimeOption">
                            Selesai lebih cepat dari jadwal
                        </label>
                    </div>
                </div>

                <div class="form-group d-none" id="costPerfDiv">
                    <label for="cost_performance">Performa Biaya dalam Project</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cost_performance" id="overCostOption"
                            value="Over" {{$track_project->cost_performance == "Over" ? "checked" : null}}>
                        <label class="form-check-label" for="overCostOption">
                            Selesai lebih dari perkiraan biaya awal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cost_performance" id="normalCostOption"
                            value="Normal" {{$track_project->cost_performance == "Normal" ? "checked" : null}}>
                        <label class="form-check-label" for="normalCostOption">
                            Selesai sesuai perkiraan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cost_performance" id="lessCostOption"
                            value="Less" {{$track_project->cost_performance == "Less" ? "checked" : null}}>
                        <label class="form-check-label" for="lessCostOption">
                            Selesai kurang dari perkiraan biaya awal
                        </label>
                    </div>
                </div>

                <div class="form-group d-none" id="qualityPerfDiv">
                    <label for="quality_performance">Performa Kualitas dalam Project</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="quality_performance" id="overQualityOption"
                            value="Over" {{$track_project->quality_performance == "Over" ? "checked" : null}}>
                        <label class="form-check-label" for="overQualityOption">
                            Diatas harapan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="quality_performance" id="normalQualityOption"
                            value="Normal" {{$track_project->quality_performance == "Normal" ? "checked" : null}}>
                        <label class="form-check-label" for="normalQualityOption">
                            Sesuai harapan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="quality_performance" id="lessQualityOption"
                            value="Less" {{$track_project->quality_performance == "Less" ? "checked" : null}}>
                        <label class="form-check-label" for="lessQualityOption">
                            Dibawah harapan
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>


@endsection

@section('script')

    <!-- Datepicker -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $('.date').datepicker({
            format: 'yyyy-mm-dd'
        });

    </script>

    <script>
        jQuery(document).ready(function() {
            $('#status').change(function() {
                switch ($(this).val()) {
                    case "Sedang Berlangsung":
                        $('#endDateDiv').addClass("d-none");
                        $('#whyFailedDiv').addClass("d-none");
                        $('#timePerfDiv').addClass("d-none");
                        $('#costPerfDiv').addClass("d-none");
                        $('#qualityPerfDiv').addClass("d-none");
                        break;
                    case "Selesai":
                        $('#endDateDiv').removeClass("d-none");
                        $('#whyFailedDiv').addClass("d-none");
                        $('#timePerfDiv').removeClass("d-none");
                        $('#costPerfDiv').removeClass("d-none");
                        $('#qualityPerfDiv').removeClass("d-none");
                        break;
                    case "Gagal":
                        $('#endDateDiv').removeClass("d-none");
                        $('#whyFailedDiv').removeClass("d-none");
                        $('#timePerfDiv').addClass("d-none");
                        $('#costPerfDiv').addClass("d-none");
                        $('#qualityPerfDiv').addClass("d-none");
                        break;
                    default:
                        break;
                }
            });
        });

    </script>

@endsection
