@extends('main')

@section('title', 'Roles')

@section('Roles', 'active')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="text-left">
            <h1 class="d-inline h3 text-gray-800">Roles</h1>
        </div>
        <div class="text-right">
            <a href="{{ url('role/create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Role Platform</a>
        </div>

    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Role</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($role as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    <a href="{{ url('role/'. $item->id)}}" class="btn btn-primary">Detail</a>
                                    <a href="{{ url('role/'. $item->id . '/edit')}}" class="btn btn-warning">Edit</a>
                                    <form action="{{ url('role/'. $item->id)}}" method="post"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin untuk menghapus data ini?')"
                                        >
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
