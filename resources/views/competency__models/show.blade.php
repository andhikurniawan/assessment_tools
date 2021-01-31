@extends('main')

@section('title', 'Detail Model Kompetensi')
@section('ModelKompetensi', 'active')
@switch(session('permission'))
    @case('admin_pm')           
    @section('superadmin', 'hidden')
        @section('admin', 'hidden')            
        @section('admin_tnd', 'hidden')            
        @section('admin_ap', 'hidden')            
        @section('admin_ot', 'hidden')            
        @break
    @case('admin')
        @section('superadmin', 'hidden')                
            @break
    @default

@endswitch

@section('content')
<div class="card shadow mb-4">
                <div class="card-body">
                <br>
            <h3 class="block-title">Detail Model Kompetensi / {{ $competencyModel->name }}</h3>
       
        <p>{{ $competencyModel->description }}.</p>
        <br>
        <h5><b>Daftar Kompetensi</b></h5>
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Action</th>
                    </tr>
                </thead>    
                <tbody>
                @php $no = 1; @endphp
                @foreach($competencyModel->competencies as $competency)
                        <tr>
                        <td>{{ $no++}}</td>
                        <td>{!! $competency->code !!}</td>
                        <td>{!! $competency->name !!}</td>
                        <td>
                                <form method="POST" action="/competencyModels/{{ $competencyModel->id }}/competencies/{{ $competency->id }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><span class="iconify" data-icon="bi:trash" data-inline="false"></span></button>
                                </form>    
                            </td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>    
</div>
<br>
</div></div>
    <div class="card">
    <div class="card-body">
            <h4 style="margin-left:-12px">Tambah Kompetensi</h4>
           
        </div>
        <div class="block-content">
        <form method="post" action="{{ route("addCompetency",$competencyModel) }}">
            @csrf
            <div class="form-group col-sm-12">
            <label>Kompetensi:</label>
            <select class="js-example-basic-multiple form-control" name="competency[]" multiple="multiple">
            @foreach ($competencies as $item)
            <option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>
            @endforeach
            </select>
            </div>
                <div class="form-group col-sm-6">
                    {!! Form::submit('Tambah', ['class' => 'btn btn-primary']) !!}
                    
                </div> 
            </form>
        </div>
    </div>

    
  
@endsection

@section('script')     
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




