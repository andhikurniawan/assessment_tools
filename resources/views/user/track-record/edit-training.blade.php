@extends('main')

@section('title', 'Edit Data Pelatihan / Sertifikat')

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
                    <h1 class="d-inline h3 text-gray-800">Edit Data Pelatihan / Sertifikasi</h1>
                </div>

            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ url('track-record/training/editProcess/'.$track_training->id) }}" method="post" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Pelatihan</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $track_training->name) }}" autofocus placeholder="Masukan Nama Pelatihan..">
                            @error('name')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="host">Nama Pelaksana</label>
                            <input type="text" name="host" id="host" class="form-control @error('host') is-invalid @enderror"
                                value="{{ old('host', $track_training->host) }}" placeholder="Masukan Nama Pelaksana Pelatihan..">
                            @error('host')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="duration">Durasi Pelatihan</label>
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="number" min="1" max="366" name="duration" id="duration"
                                        class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $track_training->duration) }}"
                                        placeholder="Durasi Pelatihan..">
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col form-control-plaintext">
                                    Hari
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="text" name="start_date" id="start_date"
                                class="date form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $track_training->start_date) }}"
                                placeholder="YYYY-MM-DD">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_date">Tanggal Selesai</label>
                            <input type="text" name="end_date" id="end_date"
                                class="date form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $track_training->end_date) }}"
                                placeholder="YYYY-MM-DD">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi Pelatihan</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                                placeholder="Masukkan Deskripsi Pelatihan..">{{ old('description', $track_training->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="form-group">
                                    <label for="certificateForm">Bukti Sertifikat</label>
                                    <input type="text" id="certificateForm" class="form-control @error('certificate') is-invalid @enderror"
                                         placeholder="Pilih File..." readonly value="{{old('certificate', $track_training->certificate)}}">
                                    <input type="file" name="certificate" id="certificate" class="form-control" onchange="sub(this)"
                                        accept="image/png, image/jpeg" hidden value="{{old('certificate', $track_training->certificate)}}">
                                        @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>
                            <div class="col-xs-1" style="padding-top: 1%">
                                <button type="button" class="btn btn-primary" onclick="getFile()">
                                    Pilih File
                                </button>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="link">Link Pelatihan</label>
                                    <input type="url" name="link" id="link" class="form-control" value="{{ old('link', $track_training->link)}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reason_associated_work">Keterkaitan Dengan Pekerjaan</label>
                            <textarea name="reason_associated_work" class="form-control @error('reason_associated_work') is-invalid @enderror" rows="5"
                                placeholder="Alasan Pelatihan ini berkaitan dengan pekerjaan saat ini">{{ old('reason_associated_work', $track_training->reason_associated_work)}}</textarea>
                                @error('reason_associated_work')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($track_training->reason_rejected != null)
                        <div class="form-group">
                            <label for="reason_rejected">Alasan Ditolak oleh Admin</label>
                            <textarea name="reason_rejected" class="form-control @error('reason_rejected') is-invalid @enderror" rows="5"
                                placeholder="" disabled>{{ old('reason_associated_work', $track_training->reason_rejected)}}</textarea>
                                @error('reason_rejected')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                            
                        @endif
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
                function getFile() {
                    document.getElementById("certificate").click();
                }

                function sub(obj) {
                    var file = obj.value;
                    var fileName = file.split("\\");
                    $('#certificateForm').val(fileName[fileName.length - 1]);
                }

            </script>

        @endsection
