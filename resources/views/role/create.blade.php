@extends('main')

@section('title', 'Roles')

@section('Roles', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url()->previous() }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Tambah Role Platform</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('role') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" name="id" id="id" class="form-control @error('id') is-invalid @enderror"
                        value="{{ old('id') }}" autofocus placeholder="Masukan ID Role">
                    @error('id')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Nama Role</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" autofocus placeholder="Masukan Nama Role..">
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
