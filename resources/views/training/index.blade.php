@extends('main')

@section('title', 'Dashboard Training and Development')

@section('TrainingDasboard', 'active')
@switch(session('permission'))
    @case('user')
        @section('user', 'hidden')            
        @break
    @case('admin_tnd')
    @section('superadmin', 'hidden')            
    @section('admin', 'hidden')            
    @section('admin_pm', 'hidden')            
    @section('admin_ap', 'hidden')            
    @section('admin_ot', 'hidden')            
        @break
        @case('admin')
        @section('superadmin', 'hidden')                
            @break
    @default

@endswitch
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halo, {{ Auth::user()->name }}</h1>
    </div>
    <div class="row">
        <div class="col-xl">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Sukses / Fail suatu Project</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <hr>
                    Data berasal dari seluruh project pada menu Track Record
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
                    <h1 class="text-center m-0 font-weight-bold text-primary" id="training">{{ $training_count }}</h1>
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Menunggu Verifikasi Track Record</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center m-0 font-weight-bold text-primary">{{ $track_count }}</h1>
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Assessment Telah Selesai</h6>
                </div>
                <div class="card-body">
                    <h1 class="text-center m-0 font-weight-bold text-primary">{{ $assessment_count }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('/style/vendor/chart.js/Chart.min.js') }}"></script>

    <script>
        var training = parseInt("{{ $training_count }}");
        console.log(training);
        var success = parseInt("{{ $success_count }}");
        var failed = parseInt("{{ $failed_count }}");
        var ctx = document.getElementById("myPieChart");
        data = {
            datasets: [{
                data: [success, failed],
                backgroundColor: ['#1cc88a', '#e74a3b'],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Sukses',
                'Gagal'
            ]
        };
        options = {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: 'rgb(46, 89, 217)',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            },
            cutoutPercentage: 80,
        };
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });

    </script>
@endsection
