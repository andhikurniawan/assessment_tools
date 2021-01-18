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
            <a href="{{ url('training/recommendation') }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Edit Data Rekomendasi Pelatihan</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{url('training/recommendation/editProcess')}}" method="post">
                @method("PUT")
                @csrf
                <div class="form-group">
                    @foreach ($training_emp as $training_emp)
                        
                    <label for="name">Nama Karyawan</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $training_emp->user->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="training_name">Nama Pelatihan</label>
                    <input type="text" name="training_name" id="training_name" class="form-control"
                        value="{{ $training_emp->training->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="host">Nama Pelaksana</label>
                    <input type="text" name="host" id="host" class="form-control"
                        value="{{  $training_emp->training->host }}" disabled>
                </div>
                <div class="form-group">
                    <label for="duration">Durasi Pelatihan</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="number" name="duration" id="duration"
                                class="form-control"
                                value="{{ $training_emp->training->duration }}" disabled>
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
                        value="{{ $training_emp->training->start_date }}" disabled >
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_date">Tanggal Selesai</label>
                    <input type="text" name="end_date" id="end_date"
                        class="date form-control "
                        value="{{ $training_emp->training->end_date }}" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Pelatihan</label>
                    <textarea name="description" class="form-control" rows="5" disabled
                        >{{ $training_emp->training->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="link">Link Pelatihan</label>
                    <input type="url" name="link" id="link" class="form-control"
                        value="{{ $training_emp->training->link }}" disabled>
                </div>
                <div class="form-group">
                    <label for="recommended_by">Direkomendasi dari</label>
                    <input type="text" name="recommended_by" id="recommended_by" class="form-control"
                        value="{{  $training_emp->recommended_by }}" disabled>
                </div>
                <div class="form-group">
                    <label for="reason">Alasan Rekomendasi</label>
                    <textarea name="reason" class="form-control" rows="5"
                        >{{ $training_emp->reason }}</textarea>
                </div>  
                <div class="form-group">
                    <label for="type">Sifat Pelatihan</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="trainingType" id="optionalOption" value="Opsional" {{$training_emp->type == "Opsional" ? "checked" : null}}>
                        <label class="form-check-label" for="optionalOption">
                          Opsional
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="trainingType" id="requiredOption" value="Wajib" {{$training_emp->type == "Wajib" ? "checked" : null}}>
                        <label class="form-check-label" for="requiredOption">
                          Wajib
                        </label>
                      </div>
                </div>
                <div class="form-group">
                    <label for="type">Batalkan Pelatihan?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cancelTraining" id="noOption" value="Tidak" checked>
                        <label class="form-check-label" for="noOption">
                          Tidak
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="cancelTraining" id="yesOption" value="Ya"}}>
                        <label class="form-check-label" for="yesOption">
                          Ya
                        </label>
                      </div>
                </div>
                <input type="hidden" name="id_training_emp" value="{{$training_emp->id}}">
                <button type="submit" class="btn btn-primary">Update</button>

            </form>
        </div>
    </div>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training_emp->training->training_competencies as $item)
                        <tr>
                            <td>{{ $item->competency->name }}</td>
                        </tr>
                        {{-- {{dd($item)}} --}}

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach

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
