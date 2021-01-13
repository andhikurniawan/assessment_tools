@extends('main')

@section('title', 'Detail Data Pegawai')

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
            <a href="{{ url()->previous() }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Detail Data Pegawai</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group">
                <label for="company_id">Perusahaan</label>
                <select class="form-control" id="company_id" name="company_id" disabled>
                    @foreach ($company as $item)
                        <option value="{{ $item->id }}" {{ $user->company_id == $item->id ? 'selected' : null }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="employee_id">Employee ID</label>
                <input type="text" name="employee_id" id="employee_id"
                    class="form-control @error('employee_id') is-invalid @enderror"
                    value="{{ old('employee_id', $user->employee_id) }}" placeholder="NIP / ID Pegawai" disabled>
                @error('employee_id')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" disabled>
                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email Pegawai</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}" placeholder="Email untuk Pegawai" disabled>
                @error('email')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Nama Pegawai</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}" placeholder="Nama Pegawai" disabled>
                @error('name')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="username">Username Pegawai</label>
                <input type="text" name="username" id="username"
                    class="form-control @error('username') is-invalid @enderror"
                    value="{{ old('username', $user->username) }}" placeholder="Username Pegawai" disabled>
                @error('username')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="gender">Jenis Kelamin</label>
                <input type="text" name="gender" id="gender" value="{{ $user->gender }}" class="form-control" disabled>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function visiblePass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

    </script>
    <script>
        $('input').attr('autocomplete', 'new-password');

    </script>
@endsection
