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
        <h1 class="h3 mb-0 text-gray-800">Gap Analysis / {{ $assessee->name }}</h1>
       
    </div>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Gap Analysis - Project Manager</h6>
        </div>
        <div class="card-body">
            <div class="col text-center" style="width: 100%;">
           
        
        <div class="card-body">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Job Target ID</th>
                    <th>Job Target</th>
                    <th>Kompetensi ID</th>
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
                {{ $totalreq = 0 }}
                {{ $totalhasil = 0 }}
                </div>
                
                @php $bobot = 0; @endphp
                @php $gap = 0; @endphp
                @php $match = 0; @endphp

                @foreach($result as $a)
                    <tr>    
                    
                    <td>{{ $no++ }}</td>
                    <td>{{ $a->job_id }}</td> 
                    <td>{{ $a->job_name }}</td> 
                    <td>{{ $a->competency_id }}</td> 
                    <td>{{ $a->competency_name }}</td> 
                    <td>{{ $a->req }}</td> 
                        <td>{{$a->hasil }}</td>
                        
                        @php $gap = (float)($a->hasil - $a->req); @endphp
                       
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
                        echo 'error';
                        }
                        @endphp
                        <td>{{ $bobot}}</td> 
                        <div style="display: none">{{$total += ($bobot)}}</div>
                        <div style="display: none">{{$totalreq += ($a->req)}}</div>
                        <div style="display: none">{{$totalhasil += ($a->hasil)}}</div>
                    </tr>   
                @endforeach
            </tbody>
            <tfoot>
                                   
                    <tr>
                        <th colspan="5" style="text-align:center">Nilai Akhir</th>
                        <th>{{$totalreq}}</th>
                        <th>{{$totalhasil}}</th>
                        <th>-</th>
                        <th>{{$total}}</th>
                   </tr>
                   <tr>
                   @php
                        if($total >= $totalreq){
                        $match = "Match";
                        }else {
                        $match = "Not Match";
                        }
                        @endphp
                        <th colspan="8" style="text-align:center">Profile Matching</th>
                        <th>{{$match}}</th>
                   </tr>
            </tfoot>
        </table>
   
</div>
            </div>  
                     </div>
            </div>
        </div>
      
        <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Gap Analysis - Programmer</h6>
        </div>
        <div class="card-body">
            <div class="col text-center" style="width: 100%;">
           
        
        <div class="card-body">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Job Target ID</th>
                    <th>Job Target</th>
                    <th>Kompetensi ID</th>
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
                {{ $totalreq = 0 }}
                {{ $totalhasil = 0 }}
                </div>
                
                @php $bobot = 0; @endphp
                @php $gap = 0; @endphp
                @php $match = 0; @endphp

                @foreach($result2 as $a)
                    <tr>    
                    
                    <td>{{ $no++ }}</td>
                    <td>{{ $a->job_id }}</td> 
                    <td>{{ $a->job_name }}</td> 
                    <td>{{ $a->competency_id }}</td> 
                    <td>{{ $a->competency_name }}</td> 
                    <td>{{ $a->req }}</td> 
                        <td>{{$a->hasil }}</td>
                        
                        @php $gap = (float)($a->hasil - $a->req); @endphp
                       
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
                        echo 'error';
                        }
                        @endphp
                        <td>{{ $bobot}}</td> 
                        <div style="display: none">{{$total += ($bobot)}}</div>
                        <div style="display: none">{{$totalreq += ($a->req)}}</div>
                        <div style="display: none">{{$totalhasil += ($a->hasil)}}</div>
                    </tr>   
                @endforeach
            </tbody>
            <tfoot>
                                   
                    <tr>
                        <th colspan="5" style="text-align:center">Nilai Akhir</th>
                        <th>{{$totalreq}}</th>
                        <th>{{$totalhasil}}</th>
                        <th>-</th>
                        <th>{{$total}}</th>
                   </tr>
                   <tr>
                   @php
                        if($total >= $totalreq){
                        $match = "Match";
                        }else {
                        $match = "Not Match";
                        }
                        @endphp
                        <th colspan="8" style="text-align:center">Profile Matching</th>
                        <th>{{$match}}</th>
                   </tr>
            </tfoot>
        </table>
   
</div>
            </div>  
                     </div>
            </div>
        </div>


        <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Gap Analysis - Analis</h6>
        </div>
        <div class="card-body">
            <div class="col text-center" style="width: 100%;">
           
        
        <div class="card-body">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Job Target ID</th>
                    <th>Job Target</th>
                    <th>Kompetensi ID</th>
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
                {{ $totalreq = 0 }}
                {{ $totalhasil = 0 }}
                </div>
                
                @php $bobot = 0; @endphp
                @php $gap = 0; @endphp
                @php $match = 0; @endphp

                @foreach($result3 as $a)
                    <tr>    
                    
                    <td>{{ $no++ }}</td>
                    <td>{{ $a->job_id }}</td> 
                    <td>{{ $a->job_name }}</td> 
                    <td>{{ $a->competency_id }}</td> 
                    <td>{{ $a->competency_name }}</td> 
                    <td>{{ $a->req }}</td> 
                        <td>{{$a->hasil }}</td>
                        
                        @php $gap = (float)($a->hasil - $a->req); @endphp
                       
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
                        echo 'error';
                        }
                        @endphp
                        <td>{{ $bobot}}</td> 
                        <div style="display: none">{{$total += ($bobot)}}</div>
                        <div style="display: none">{{$totalreq += ($a->req)}}</div>
                        <div style="display: none">{{$totalhasil += ($a->hasil)}}</div>
                    </tr>   
                @endforeach
            </tbody>
            <tfoot>
                                   
                    <tr>
                        <th colspan="5" style="text-align:center">Nilai Akhir</th>
                        <th>{{$totalreq}}</th>
                        <th>{{$totalhasil}}</th>
                        <th>-</th>
                        <th>{{$total}}</th>
                   </tr>
                   <tr>
                   @php
                        if($total >= $totalreq){
                        $match = "Match";
                        }else {
                        $match = "Not Match";
                        }
                        @endphp
                        <th colspan="8" style="text-align:center">Profile Matching</th>
                        <th>{{$match}}</th>
                   </tr>
            </tfoot>
        </table>
   
</div>
            </div>  
                     </div>
            </div>
        </div>
       
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
        } );
    </script>

    <!-- Page level plugins -->
    <script src="{{ asset('style/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('style/js/demo/datatables-demo.js') }}"></script>
@endsection


