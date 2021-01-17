@extends('main')

@section('title', 'Employee')

@section('DataPegawai', 'active')
@switch(session('permission'))
    @case('user')
        @section('user', 'hidden')            
        @break
    @case('admin')
    @section('superadmin', 'hidden')                
        @break
    @default

@endswitch

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <h1 class="d-inline h3 text-gray-800">Data Pegawai</h1>
            <br>
            <br>
            <h1 class=" h4 text-gray-800">Perusahaan</h1>
            <select name="company" id="company" class="form-control"
                onchange="window.location.href=this.options[this.selectedIndex].value;">
                @if (Auth::user()->company_id != null)
                <option value="{{$company->id}}" selected>{{ $company->name}}</option>
                    
                @else
                <option value="{{ url('employee/') }}">Semua Karyawan</option>
                @foreach ($company as $item)
                    <option value="{{ url('employee/company', $item->id) }}"
                        {{ $selected == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                @endforeach    
                @endif
            </select>
        </div>
        <div class="text-right">
            <a href="{{ url('employee/create-admin') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <span
                    class="iconify text-white-50 fa-m" data-icon="ic:round-admin-panel-settings" data-inline="false"></span>
                Tambahkan Data Admin</a>
            <a href="{{ url('employee/create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data Pegawai</a>
        </div>

    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pegawai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Employee ID</th>
                            <th>Role</th>
                            <th>Company</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->employee_id }}</td>
                                <td>{{ $item->role_name }}</td>
                                <td>{{ $item->company_name }}</td>
                                <td class="text-center">
                                    <a href="{{ url('employee/' . $item->id) }}" class="btn btn-primary">Detail</a>
                                    <a href="{{ url('employee/' . $item->id . '/edit') }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ url('employee/' . $item->id) }}" method="post" class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin untuk menghapus data ini?')">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger">Hapus</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection
