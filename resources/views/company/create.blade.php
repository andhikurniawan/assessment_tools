@extends('main')

@section('title', 'Create Company')

@section('DataPerusahaan', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url()->previous() }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Tambah Data Perusahaan</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ url('company') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Perusahaan</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" autofocus placeholder="Masukan Nama Perusahaan..">
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Alamat Perusahaan</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="5"
                        placeholder="Masukkan Alamat Peusahaan..">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telp">Telepon Perusahaan</label>
                    <input type="tel" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror"
                        value="{{ old('telp') }}" placeholder="Masukan Nomer Telepon Perusahaan..">
                    @error('telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fax">Fax Perusahaan</label>
                    <input type="tel" name="fax" id="fax" class="form-control @error('fax') is-invalid @enderror"
                        value="{{ old('fax') }}" placeholder="Masukan Nomer Telepon Perusahaan..">
                    @error('fax')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email Perusahaan</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="Masukan Email Perusahaan..">
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Perusahaan</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                        placeholder="Masukkan Deskripsi Peusahaan..">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="contact_person">Contact Person</label>
                    <input type="text" name="contact_person" id="contact_person" class="form-control @error('contact_person') is-invalid @enderror"
                        value="{{ old('contact_person') }}" autofocus placeholder="Masukan Contact Person Perusahaan..">
                    @error('contact_person')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('script')

@endsection
