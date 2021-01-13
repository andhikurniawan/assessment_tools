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
            <a href="{{ url('training/master') }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Tambah Data Pelatihan</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('training') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="company_id">Perusahaan</label>
                    <select class="form-control" id="company_id" name="company_id">
                        @foreach ($company as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama Pelatihan</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" autofocus placeholder="Masukan Nama Pelatihan..">
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="host">Nama Pelaksana</label>
                    <input type="text" name="host" id="host" class="form-control @error('host') is-invalid @enderror"
                        value="{{ old('host') }}" placeholder="Masukan Nama Pelaksana Pelatihan..">
                    @error('host')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="duration">Durasi Pelatihan</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="number" min="1" max="366" name="duration" id="duration"
                                class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}"
                                placeholder="Durasi Pelatihan">
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
                        class="date form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}"
                        placeholder="YYYY-MM-DD">
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_date">Tanggal Selesai</label>
                    <input type="text" name="end_date" id="end_date"
                        class="date form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}"
                        placeholder="YYYY-MM-DD">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Pelatihan</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                        placeholder="Masukkan Deskripsi Pelatihan..">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="link">Link Pelatihan</label>
                    <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror"
                        value="{{ old('link') }}" placeholder="Masukan Link Pelatihan..">
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="training_competency">Kompetensi yang Terkait</label>
                    <select class="js-example-basic-multiple form-control" name="competency[]" multiple="multiple">
                        @foreach ($competency as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Pilih Kompetensi",
                closeOnSelect: false
            });
        });
    </script>
@endsection
