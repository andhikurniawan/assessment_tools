<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Web Assessment</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('style/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

         
    <!-- Custom styles for this template-->
    <link href="{{ asset('style/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('style/css/training.css') }}" rel="stylesheet">
    <link href="{{asset('style/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-window-restore"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Web Assessment</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <div @yield('admin')>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item @yield('dashboard')">
                <a class="nav-link" href="/home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
        </div>


            <!-- Heading -->
            
            <div @yield('superadmin')>

            <div class="sidebar-heading">
                Master
            </div>

            <!-- Nav Item  -->
            <li class="nav-item @yield('DataPerusahaan')">
                <a class="nav-link" href="{{url('company')}}">
                    <i class="fas fa-database"></i>
                    <span>Data Perusahaan</span></a>
            </li>

            <!-- Nav Item  -->
            <li class="nav-item @yield('Roles')">
                <a class="nav-link" href="{{url('role')}}">
                    <span class="iconify" data-icon="ic:round-admin-panel-settings" data-inline="false"></span>
                    <span>Role</span></a>
            </li>
            </div>
       

        <div @yield('admin')>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Optimasi Tim
            </div>

            <!-- Nav Item  -->
            <li class="nav-item @yield('DataPegawai')">
                <a class="nav-link" href="{{ url('employee')}}">
                    <i class="fas fa-database"></i>
                    <span>Data Pegawai</span></a>
            </li>
            <!-- Nav Item  -->
            <li class="nav-item @yield('JobTarget')">
                <a class="nav-link" href="{{ url('jobTargets') }}">
                    <span class="iconify" data-icon="bx:bx-target-lock" data-inline="false"></span>
                    <span>Job Target</span></a>
            </li>
            <li class="nav-item @yield('JobTarget')">
                <a class="nav-link" href="{{ url('teams') }}">
                    <span class="iconify" data-icon="bx:bx-target-lock" data-inline="false"></span>
                    <span>Teams</span></a>
            </li>
        </div>

        <div @yield('admin_pm')>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Profile Matching
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item @yield('Dashboard')">
                <a class="nav-link" href="/dashboardPms">
                    <i class="fas fa-tasks"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item @yield('GrupKompetensi')">
                <a class="nav-link" href="/competencyGroups">
                    <i class="fas fa-tasks"></i>
                    <span>Grup Kompetensi</span></a>
            </li>

            <!-- Nav Item  -->
            <li class="nav-item @yield('kompetensi')">
                <a class="nav-link" href="/competencies">
                    <i class="fas fa-tasks"></i>
                    <span>Kompetensi</span></a>
            </li>


            <!-- Nav Item - Tables -->
            <li class="nav-item @yield('ModelKompetensi')">
                <a class="nav-link" href="/competencyModels">
                    <i class="fas fa-tasks"></i>
                    <span>Model Kompetensi</span></a>
            </li>
            <!-- Nav Item - Tables -->
            <li class="nav-item @yield('GapAnalysis')">
                <a class="nav-link" href="/gapAnalyses">
                    <i class="fas fa-tasks"></i>
                    <span>Gap Analysis</span></a>
            </li>
        </div>

        <div @yield('admin_ap')>

        
            <!-- Divider -->
            <hr class="sidebar-divider">
  
            <!-- Heading -->
            <div class="sidebar-heading">
                Appraisal
            </div>

            <!-- Nav Item  -->
            <li class="nav-item @yield('SesiAssessment')">
                <a class="nav-link" href="{!! route('assessmentSessions.index') !!}">
                    <i class="fas fa-tasks"></i>
                    <span>Sesi Assessment</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item @yield('ReportAssessment')">
                <a class="nav-link" href="{{ route('result') }}">
                    <i class="fas fa-tasks"></i>
                    <span>Report Assessment</span></a>
            </li>
        </div>

        <div @yield('admin_tnd')>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Training and Development
            </div>

            <!-- Nav Item  -->
            <li class="nav-item @yield('TrainingDasboard')" @yield('user')>
                <a class="nav-link" href="{{ url('training/dashboard') }}">
                    <span class="iconify" data-icon="bx:bxs-dashboard" data-inline="false"></span>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item  -->
            <li class="nav-item @yield('TrainingRecommendation')">
                <a class="nav-link" href="{{ url('training/recommendation') }}">
                    <span class="iconify" data-icon="fluent:text-bullet-list-square-24-filled" data-inline="false"></span>
                    <span>Training Recommendation</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item @yield('TrackRecord')">
                <a class="nav-link" href="{{ url('track-record')}}">
                    <span class="iconify" data-icon="clarity:file-group-solid" data-inline="false"></span>
                    <span>Track Record</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        </div>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('style/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Web Assessment {{ date('Y')}}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Logout" untuk keluar dari aplikasi web</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('style/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('style/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('style/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('style/js/sb-admin-2.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('script')
   

</body>

</html>
