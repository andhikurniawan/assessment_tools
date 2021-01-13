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
            <h1 class="d-inline h3 text-gray-800">Edit Data Pelatihan</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('training/' . $training->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="company_id">Perusahaan</label>
                    <select class="form-control" id="company_id" name="company_id">
                        @foreach ($company as $item)
                            <option value="{{ $item->id }}" {{$item->id == $training->company_id ? "selected" : null}}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama Pelatihan</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $training->name) }}" autofocus placeholder="Masukan Nama Pelatihan..">
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="host">Nama Pelaksana</label>
                    <input type="text" name="host" id="host" class="form-control @error('host') is-invalid @enderror"
                        value="{{ old('host', $training->host) }}" placeholder="Masukan Nama Pelaksana Pelatihan..">
                    @error('host')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="duration">Durasi Pelatihan</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="number" min="1" max="366" name="duration" id="duration"
                                class="form-control @error('duration') is-invalid @enderror"
                                value="{{ old('duration', $training->duration) }}" placeholder="">
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
                        class="date form-control @error('start_date') is-invalid @enderror"
                        value="{{ old('start_date', $training->start_date) }}" placeholder="YYYY-MM-DD">
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_date">Tanggal Selesai</label>
                    <input type="text" name="end_date" id="end_date"
                        class="date form-control @error('end_date') is-invalid @enderror"
                        value="{{ old('end_date', $training->end_date) }}" placeholder="YYYY-MM-DD">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Pelatihan</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                        placeholder="Masukkan Deskripsi Pelatihan..">{{ old('description', $training->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="link">Link Pelatihan</label>
                    <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror"
                        value="{{ old('linnk', $training->link) }}" placeholder="Masukan Link Pelatihan..">
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kompetensi yang Terkait</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kompetensi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training_competency as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <form action="{{ url('training/master/competency/' . $item->id) }}" method="post"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin untuk menghapus data ini?')">
                                        @method('delete')
                                        @csrf
                                        <input type="text" name="id_training" value="{{ $training->id }}" hidden>
                                        <button class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <hr>
            <form action="{{ url('training/master/competency')}}" method="post">
            @csrf
            <div class="form-group">
                <input type="hidden" name="id_training" value="{{$training->id}}">
                <label for="training_competency">Tambahkan Kompetensi yang Terkait</label>
                <select class="js-example-basic-multiple form-control" name="competency[]" multiple="multiple">
                    @foreach ($competency as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambahkan</button>

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

    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection
