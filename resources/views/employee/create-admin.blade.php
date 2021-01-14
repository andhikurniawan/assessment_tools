@extends('main')

@section('title', 'Tambah Data Admin')

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
            <h1 class="d-inline h3 text-gray-800">Tambah Data Admin</h1>
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
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="employee_id">Employee ID</label>
                    <input type="text" name="employee_id" id="employee_id"
                        class="form-control @error('employee_id') is-invalid @enderror" value="{{ old('employee_id') }}"
                        placeholder="NIP / ID Admin">
                    @error('employee_id')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                        @foreach ($role as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email Admin</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="Email untuk Admin">
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Nama Admin</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Nama Admin">
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Username Admin</label>
                    <input type="text" name="username" id="username"
                        class="form-control @error('username') is-invalid @enderror" autocomplete="new-password"
                        value="{{ old('username') }}" placeholder="Username Admin">
                    @error('username')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="Pria">Laki-laki</option>
                        <option value="Wanita">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password Admin</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                        placeholder="Password Admin">
                    @error('password')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" onclick="visiblePass()">Tampilkan Password
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </form>
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
