@extends('main')

@section('title', 'Gap Analysis')

@section('GapAnalysis', 'active')
@switch(session('permission'))
    @case('admin_pm')           
    @section('superadmin', 'hidden')
        @section('admin', 'hidden')            
        @section('admin_tnd', 'hidden')            
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
        <h1 class="h3 mb-3 text-gray-800">Gap Analysis / {{ $assessee->name }}</h1>
    </div>

    @foreach($jobs as $key => $j)
            <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Gap Analysis - {{ $j->job_name }}</h6>
        </div>
        <div class="card-body">
            <div class="col text-center" style="width: 100%;">
           
        
        <div class="card-body">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kompetensi</th>
                    <th>Job Requirement</th>
                    <th>Hasil Assessment</th>
                    <th>Gap</th>
                    <th>Bobot Nilai Gap</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                <div style="display: none">
	            {{ $total = 0 }}
                </div>
                @php $bobot = 0; @endphp
                @php $gap = 0; @endphp
                @php $match = 0; @endphp

                @foreach($result as $a)
                    <tr>    
                    
                    <td>{{ $no++ }}</td>
                        <td>{{ $a->competency_name }}</td> 
                        <td>4</td> 
                        <td>{{ (float)$a->modus_level }}</td>
                        
                        @php $gap = (float)($a->modus_level - 4); @endphp

                        <td>{{ $gap}}</td> 
                        
                        @php
                        if($gap == '0'){
                        $bobot = 5;
                        } else if($gap == '1'){
                        $bobot = 4.5;
                        } else if($gap == '-1'){
                        $bobot = 4;
                        } else if($gap == '2'){
                        $bobot = 3.5;
                        } else if($gap == '-2'){
                        $bobot = 3;
                        }else if($gap == '3'){
                        $bobot = 2.5;
                        } else if($gap == '-3'){
                        $bobot = 2;
                        }else if($gap == '4'){
                        $bobot = 1.5;
                        } else if($gap == '-4'){
                        $bobot = 1;
                        }else {
                        echo 'pusing';
                        }
                        @endphp
                        <td>{{ $bobot}}</td> 
                        <div style="display: none">{{$total += ($bobot)}}</div>
                       
                    </tr>   
                @endforeach
            </tbody>
            <tfoot>
                                   
                    <tr>
                        <th colspan="5" style="text-align:center">Nilai Akhir</th>
                        <th>{{$total}}</th>
                   </tr>
                   <tr>
                   @php
                        if($total >= '50'){
                        $match = "Match";
                        }else {
                        $match = "Not Match";
                        }
                        @endphp
                        <th colspan="5" style="text-align:center">Profile Matching</th>
                        <th>{{$match}}</th>
                   </tr>
            </tfoot>
        </table>
   
</div>
            </div>
            <hr>     
                     </div>
            </div>
    
            @endforeach

 
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">

    $(document).ready(function(){

        $("#tableAssessee").DataTable();

        $(document).on("click", "button.btn-submit", function(){

            $("#id").val(this.id);

            alert(this.id);

        });

    });

</script>

@endsection
@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection
