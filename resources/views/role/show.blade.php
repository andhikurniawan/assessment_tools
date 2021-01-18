@extends('main')

@section('title', 'Detail Roles')

@section('Roles', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url()->previous() }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Detail Role Platform</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" name="id" id="id" class="form-control @error('id') is-invalid @enderror"
                        value="{{ old('id', $role->id) }}" autofocus placeholder="Masukan ID Role" disabled>
                    @error('id')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Nama Role</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $role->name) }}" autofocus placeholder="Masukan Nama Role.." disabled>
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="is_admin">Apakah Admin?</label>
                    <select class="form-control" id="is_admin" name="is_admin" disabled>
                        <option value="0" {{$role->is_admin == 0 ? "selected" : null}}>Tidak</option>
                        <option value="1" {{$role->is_admin == 1 ? "selected" : null}}>Ya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="is_superadmin">Apakah SuperAdmin?</label>
                    <select class="form-control" id="is_superadmin" name="is_superadmin" disabled>
                        <option value="0" {{$role->is_superadmin == 0 ? "selected" : null}}>Tidak</option>
                        <option value="1" {{$role->is_superadmin == 1 ? "selected" : null}}>Ya</option>
                    </select>
                </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
