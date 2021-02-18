@extends('main')

@section('title', 'Report Assessment Session')

@section('ReportAssessment', 'active')
@switch(session('permission'))
    @case('user')
        @section('user', 'hidden')
        @section('superadmin', 'hidden')            
        @section('admin', 'hidden')            
        @section('admin_pm', 'hidden')            
        @section('admin_ot', 'hidden')                   
        @break
    @case('admin_tnd')
        @section('superadmin', 'hidden')            
        @section('admin', 'hidden')            
        @section('admin_pm', 'hidden')            
        @section('admin_ap', 'hidden')            
        @section('admin_ot', 'hidden')            
        @break
    @case('admin_ap')
    @section('superadmin', 'hidden')            
    @section('admin', 'hidden')            
    @section('admin_pm', 'hidden')            
    @section('admin_tnd', 'hidden')            
    @section('admin_ot', 'hidden')  
    @break
    @case('admin')
        @section('superadmin', 'hidden')                
            @break
    @default

@endswitch
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-3 text-gray-800">Report Individu</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Session</h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>   
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;Assessment :</td>
                        <td>{{ $session->name }}</td>
                    </tr>
                    <tr>   
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td>{{ date('M d, Y', strtotime($session->start_date)) }}</td>
                    </tr>
                    <tr>   
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;Assesse Name :</td>
                        <td>{{ $assessee->name }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
     
       
            @foreach($group as $key => $g)
            <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Competency Result</h6>
        </div>
        <div class="card-body">
            <div class="col text-center" style="width: 90%;">
                <h4 style="margin-bottom:30px;">{{ $g }}</h4>
                <canvas id="myChart{{ $key }}"></canvas>
            </div>
            <hr>
                    Data diperoleh dari hasil assessment
            </div>
            </div>
            @endforeach
      

            @foreach($jobs as $key => $j)
            <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Spider Chart Perbandingan Job Target dan Competency Result</h6>
        </div>
        <div class="card-body">
            <div class="col text-center" style="width: 100%;">
                <h3>{{ $j->job_name }}</h3>
                <canvas id="spiderChart{{ $key }}"></canvas>
            </div>
            <hr>
            Jumlah Spider Chart sesuai dengan jumlah Job Target yang digunakan pada Assessment Session
            </div>
            </div>
    
            @endforeach


<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous"></script>
<script type="text/javascript">

    $(document).ready(function(){

    var result = {!! json_encode($result) !!};  
    var group = {!! json_encode($group) !!};
    
    var labels = [];
    var value = [];
    var bg = [];

    var jobs = {!! json_encode($jobs) !!}

    var labels_spider = [];
    var value1_spider = [];
    var value2_spider = [];

    for(var i = 0; i < group.length; i++)
    {
        labels[i] = [];
        value[i] = [];

        for(var j = 0; j < result.length; j++)
        {
            if(result[j]["group"] == group[i])
            {
                labels[i].push(result[j]["competency_name"]);
                value[i].push(result[j]["modus_level"]);
            }
        }
    }

    for(var i = 0; i < jobs.length; i++)
    {
        value1_spider[i] = []; // Req
        value2_spider[i] = []; // Res
        labels_spider[i] = [];

        for(var j = 0; j < jobs[i]["req"].length; j++)
        {
            
            labels_spider[i].push(jobs[i]["req"][j].name)
            value1_spider[i].push(jobs[i]["req"][j].level);
            value2_spider[i].push(jobs[i]["result"][j].modus_level);
        }
    }

    for(var i = 0; i < result.length; i++)
    {
        labels.push(result[i]["competency_name"]);
        value.push(result[i]["modus_level"]);
        bg.push("rgb(50, 66, 168)");
    }

    for(var i = 0; i < value1_spider.length; i++)
    {   
        var canvas = document.getElementById("spiderChart" + i);

        // alert(JSON.stringify("value 1 : " + value1_spider[i]));
        // alert(JSON.stringify("value 2 : " + value2_spider[i]));

        var marksData = {
            labels: labels_spider[i],
            datasets: [{
                label: "Job Requirement",
                backgroundColor: "rgb(21, 234, 237, 0.1)",
                borderColor: "rgb(21, 234, 237)",
                radius: 6,
                pointRadius: 6,
                pointBorderWidth: 3,
                pointBorderColor: "black",
                pointBackgroundColor: "rgb(21, 234, 237)",
                data: value1_spider[i]
            },{
                label: "Result",
                backgroundColor: "rgba(212, 129, 195, 0.1)",
                borderColor: "rgb(212, 129, 195)",
                radius: 6,
                pointRadius: 6,
                pointBorderWidth: 3,
                pointBorderColor: "black",
                pointBackgroundColor: "rgb(212, 129, 195)",
                data: value2_spider[i]
            }]
        };

        var radarChart = new Chart(canvas, {
            type: 'radar',
            data: marksData,
            options: {
                scale: {
                    ticks: {
                        min: 0,
                        beginAtZero: true
                    }
                }
            }
        });
    }

    for(var i = 0; i < group.length; i++)
    {
        var ctx = document.getElementById('myChart' + i).getContext('2d');

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels[i],
                datasets: [{
                    label: "Competency Level",
                    data: value[i],
                    backgroundColor: "rgb(33, 191, 115)"
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }


    });

</script>

@endsection