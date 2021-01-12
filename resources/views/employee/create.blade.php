@extends('main')

@section('title', 'Tambah Data Pegawai')

@section('DaftarPegawai', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url()->previous() }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Tambah Data Pegawai</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('employee') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="company_id">Perusahaan</label>
                    <select class="form-control" id="company_id" name="company_id">
                        @foreach ($company as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="employee_id">Employee ID</label>
                    <input type="text" name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror"
                        value="{{ old('employee_id') }}" placeholder="NIP / ID Pegawai">
                    @error('employee_id')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="{{$role->id}}" selected disabled>{{$role->name}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama Pegawai</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Masukan Nama Role..">
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="is_admin">Apakah Admin?</label>
                    <select class="form-control" id="is_admin" name="is_admin">
                        <option value="0">Tidak</option>
                        <option value="1">Ya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="is_superadmin">Apakah SuperAdmin?</label>
                    <select class="form-control" id="is_superadmin" name="is_superadmin">
                        <option value="0">Tidak</option>
                        <option value="1">Ya</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </form>
        </div>
    </div>
@endsection

@section('script')

@endsection
