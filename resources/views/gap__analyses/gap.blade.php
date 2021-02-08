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
        <h1 class="h3 mb-0 text-gray-800">Gap Analysis / {{ $assessee->name }} ({{ $assessee->employee_id }})</h1>
       
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
                    <th>Kompetensi</th>
                    <th>Profil Karyawan</th>
                    <th>Profil Jabatan</th>
                    <th>Gap</th>
                    <th>Bobot Nilai Gap</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                <div style="display: none">
	            {{ $total = 0 }}
                {{ $total2 = 0 }}
                {{ $totalreq = 0 }}
                {{ $totalhasil = 0 }}
                {{ $jenis = 0 }}
                </div>
                
                @php $bobot = 0; @endphp
                @php $gap = 0; @endphp
                @php $match = 0; @endphp
                @php $core = 0; @endphp

                @foreach($coba as $a)
                    <tr>    
                    
                    <td>{{ $no++ }}</td>
                    <td>{{ $a->kompetensi }}</td> 
                    <td>{{$a->hasil }}</td>
                    <td>{{ $a->req }}</td> 
                        
                        
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
                        <div style="display: none">{{$jenis == ($a->jenis)}}</div>
                        <div style="display: none">{{$total2 += ($bobot) / 24}}</div>
                    </tr>   
                @endforeach
            </tbody>
            <tfoot>
                   @php
                        if($jenis == 'core'){
                        $core = 5;
                        } else {
                            $core = 0;
                        }
                        @endphp
                   <tr>
                        <td colspan="5" style="text-align:center">Nilai Core Competencies</td>
                        <td>{{$total2}}</td>
                   </tr>
            </tfoot>
        </table>
   
</div>

<div class="card-body">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kompetensi</th>
                    <th>Profil Karyawan</th>
                    <th>Profil Jabatan</th>
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
                {{ $jenis = 0 }}
                </div>
                
                @php $bobot = 0; @endphp
                @php $gap = 0; @endphp
                @php $match = 0; @endphp
                @php $core = 0; @endphp

                @foreach($cobaa as $a)
                    <tr>    
                    
                    <td>{{ $no++ }}</td>
                    <td>{{ $a->kompetensi }}</td> 
                    <td>{{$a->hasil }}</td>
                    <td>{{ $a->req }}</td> 
                        
                        
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
                        <div style="display: none">{{$total += ($bobot) / 3}}</div>
                        <div style="display: none">{{$totalreq += ($a->req)}}</div>
                        <div style="display: none">{{$totalhasil += ($a->hasil)}}</div>
                        <div style="display: none">{{$jenis == ($a->jenis)}}</div>
                    </tr>   
                @endforeach
            </tbody>
            <tfoot>
                                
                   @php
                        if($jenis == 'core'){
                        $core = 5;
                        } else {
                            $core = 0;
                        }
                        @endphp
                   
                   <tr>
                        <td colspan="5" style="text-align:center">Nilai Secondary Competencies</td>
                        <td>{{$total}}</td>
                   </tr>
                   
            </tfoot>
        </table>
        <br>
        @php $totall = (60/100*$total2) + (40/100*$total); @endphp
        <b> Hasil Akhir : {{ $totall }} </b> 
        <br>
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
                    <th>Kompetensi</th>
                    <th>Profil Karyawan</th>
                    <th>Profil Jabatan</th>
                    <th>Gap</th>
                    <th>Bobot Nilai Gap</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                <div style="display: none">
	            {{ $total = 0 }}
                {{ $total2 = 0 }}
                {{ $totalreq = 0 }}
                {{ $totalhasil = 0 }}
                {{ $jenis = 0 }}
                </div>
                
                @php $bobot = 0; @endphp
                @php $gap = 0; @endphp
                @php $match = 0; @endphp
                @php $core = 0; @endphp

                @foreach($coba2 as $a)
                    <tr>    
                    
                    <td>{{ $no++ }}</td>
                    <td>{{ $a->kompetensi }}</td> 
                    <td>{{$a->hasil }}</td>
                    <td>{{ $a->req }}</td> 
                        
                        
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
                        <div style="display: none">{{$jenis == ($a->jenis)}}</div>
                        <div style="display: none">{{$total2 += ($bobot) / 24}}</div>
                    </tr>   
                @endforeach
            </tbody>
            <tfoot>
                   @php
                        if($jenis == 'core'){
                        $core = 5;
                        } else {
                            $core = 0;
                        }
                        @endphp
                   <tr>
                        <td colspan="5" style="text-align:center">Nilai Core Competencies</td>
                        <td>{{$total2}}</td>
                   </tr>
            </tfoot>
        </table>
   
</div>

<div class="card-body">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kompetensi</th>
                    <th>Profil Karyawan</th>
                    <th>Profil Jabatan</th>
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
                {{ $jenis = 0 }}
                </div>
                
                @php $bobot = 0; @endphp
                @php $gap = 0; @endphp
                @php $match = 0; @endphp
                @php $core = 0; @endphp

                @foreach($cobaa2 as $a)
                    <tr>    
                    
                    <td>{{ $no++ }}</td>
                    <td>{{ $a->kompetensi }}</td> 
                    <td>{{$a->hasil }}</td>
                    <td>{{ $a->req }}</td> 
                        
                        
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
                        <div style="display: none">{{$total += ($bobot) / 3}}</div>
                        <div style="display: none">{{$totalreq += ($a->req)}}</div>
                        <div style="display: none">{{$totalhasil += ($a->hasil)}}</div>
                        <div style="display: none">{{$jenis == ($a->jenis)}}</div>
                    </tr>   
                @endforeach
            </tbody>
            <tfoot>
                                
                   @php
                        if($jenis == 'core'){
                        $core = 5;
                        } else {
                            $core = 0;
                        }
                        @endphp
                   
                   <tr>
                        <td colspan="5" style="text-align:center">Nilai Secondary Competencies</td>
                        <td>{{$total}}</td>
                   </tr>
                   
            </tfoot>
        </table>
        <br>
        @php $totall = (60/100*$total2) + (40/100*$total); @endphp
        <b> Hasil Akhir : {{ $totall }} </b> 
        <br>
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
                    <th>Kompetensi</th>
                    <th>Profil Karyawan</th>
                    <th>Profil Jabatan</th>
                    <th>Gap</th>
                    <th>Bobot Nilai Gap</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                <div style="display: none">
	            {{ $total = 0 }}
                {{ $total2 = 0 }}
                {{ $totalreq = 0 }}
                {{ $totalhasil = 0 }}
                {{ $jenis = 0 }}
                </div>
                
                @php $bobot = 0; @endphp
                @php $gap = 0; @endphp
                @php $match = 0; @endphp
                @php $core = 0; @endphp

                @foreach($coba3 as $a)
                    <tr>    
                    
                    <td>{{ $no++ }}</td>
                    <td>{{ $a->kompetensi }}</td> 
                    <td>{{$a->hasil }}</td>
                    <td>{{ $a->req }}</td> 
                        
                        
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
                        <div style="display: none">{{$jenis == ($a->jenis)}}</div>
                        <div style="display: none">{{$total2 += ($bobot) / 24}}</div>
                    </tr>   
                @endforeach
            </tbody>
            <tfoot>
                   @php
                        if($jenis == 'core'){
                        $core = 5;
                        } else {
                            $core = 0;
                        }
                        @endphp
                   <tr>
                        <td colspan="5" style="text-align:center">Nilai Core Competencies</td>
                        <td>{{$total2}}</td>
                   </tr>
            </tfoot>
        </table>
   
</div>

<div class="card-body">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kompetensi</th>
                    <th>Profil Karyawan</th>
                    <th>Profil Jabatan</th>
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
                {{ $jenis = 0 }}
                </div>
                
                @php $bobot = 0; @endphp
                @php $gap = 0; @endphp
                @php $match = 0; @endphp
                @php $core = 0; @endphp

                @foreach($cobaa3 as $a)
                    <tr>    
                    
                    <td>{{ $no++ }}</td>
                    <td>{{ $a->kompetensi }}</td> 
                    <td>{{$a->hasil }}</td>
                    <td>{{ $a->req }}</td> 
                        
                        
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
                        <div style="display: none">{{$total += ($bobot) / 3}}</div>
                        <div style="display: none">{{$totalreq += ($a->req)}}</div>
                        <div style="display: none">{{$totalhasil += ($a->hasil)}}</div>
                        <div style="display: none">{{$jenis == ($a->jenis)}}</div>
                    </tr>   
                @endforeach
            </tbody>
            <tfoot>
                                
                   @php
                        if($jenis == 'core'){
                        $core = 5;
                        } else {
                            $core = 0;
                        }
                        @endphp
                   
                   <tr>
                        <td colspan="5" style="text-align:center">Nilai Secondary Competencies</td>
                        <td>{{$total}}</td>
                   </tr>
                   
            </tfoot>
        </table>
        <br>
        @php $totall = (60/100*$total2) + (40/100*$total); @endphp
        <b> Hasil Akhir : {{ $totall }} </b> 
        <br>
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


