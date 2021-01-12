@extends('main')

@section('title', 'Detail Company')

@section('DataPerusahaan', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <a href="{{ url()->previous() }}" class="d-sm-inline text-decoration-none text-muted">
                <i class="fas fa-chevron-left fa-lg" style="width: 20px"></i>
            </a>
            <h1 class="d-inline h3 text-gray-800">Detail Data Perusahaan</h1>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Perusahaan</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $company->name) }}" placeholder="Masukan Nama Perusahaan.." disabled>
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Alamat Perusahaan</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="5"
                        placeholder="Masukkan Alamat Peusahaan.." disabled>{{ old('address', $company->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telp">Telepon Perusahaan</label>
                    <input type="tel" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror"
                        value="{{ old('telp', $company->telp) }}" placeholder="Masukan Nomer Telepon Perusahaan.." disabled>
                    @error('telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fax">Fax Perusahaan</label>
                    <input type="tel" name="fax" id="fax" class="form-control @error('fax') is-invalid @enderror"
                        value="{{ old('fax', $company->fax) }}" placeholder="Masukan Nomer Telepon Perusahaan.." disabled>
                    @error('fax')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email Perusahaan</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $company->email) }}" placeholder="Masukan Email Perusahaan.." disabled>
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Perusahaan</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                        placeholder="Masukkan Deskripsi Peusahaan.." disabled>{{ old('description', $company->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="contact_person">Contact Person</label>
                    <input type="text" name="contact_person" id="contact_person" class="form-control @error('contact_person') is-invalid @enderror"
                        value="{{ old('contact_person', $company->contact_person) }}" autofocus placeholder="Masukan Contact Person Perusahaan.." disabled>
                    @error('contact_person')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
