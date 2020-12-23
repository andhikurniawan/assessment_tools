@extends('main')

@section('title', 'Dashboard Training and Development')

@section('TrainingDashboard', 'active')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Halo, {{ Auth::user()->name}}</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<div class="row">
    <div class="col-xl">

        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Sukses / Fail suatu Project</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
                <hr>
                Styling for the area chart can be found in the
                <code>/js/demo/chart-area-demo.js</code> file.
            </div>
        </div>
        </div>

    </div>

<div class="row">
    <div class="col-xl">
        <div class="card shadow mb-4">
            <div class="card-header py-3 text-center">
                <h6 class="m-0 font-weight-bold text-primary">Jumlah Rekomendasi Pelatihan</h6>
            </div>
            <div class="card-body">
                <h1 class="text-center m-0 font-weight-bold text-primary">10</h1>
            </div>
        </div>
    </div>
    <div class="col-xl">
        <div class="card shadow mb-4">
            <div class="card-header py-3 text-center">
                <h6 class="m-0 font-weight-bold text-primary">Jumlah Menunggu Verifikasi Track Record</h6>
            </div>
            <div class="card-body">
                <h1 class="text-center m-0 font-weight-bold text-primary">5</h1>
            </div>
        </div>
    </div>
    <div class="col-xl">
        <div class="card shadow mb-4">
            <div class="card-header py-3 text-center">
                <h6 class="m-0 font-weight-bold text-primary">Jumlah Assessment Telah Selesai</h6>
            </div>
            <div class="card-body">
                <h1 class="text-center m-0 font-weight-bold text-primary">5</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
        <!-- Page level plugins -->
        <script src="{{ asset('/style/vendor/chart.js/Chart.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('/style/js/demo/chart-area-demo.js')}}"></script>
        <script src="{{ asset('/style/js/demo/chart-pie-demo.js')}}"></script>
        <script src="{{ asset('/style/js/demo/chart-bar-demo.js')}}"></script>
@endsection