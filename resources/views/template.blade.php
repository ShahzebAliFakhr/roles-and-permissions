<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{url('sb-admin')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{url('sb-admin')}}/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{url('sb-admin')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{url('sb-admin')}}/vendor/select-2/select2.min.css" rel="stylesheet">
    <link href="{{url('sb-admin')}}/css/custom.css" rel="stylesheet">

    @yield('header')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ env('APP_NAME')}}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{url('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('roles')}}">
                    <i class="fas fa-fw fa-users mr-2"></i>
                    <span>Roles</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{url('profile')}}">
                    <i class="fas fa-fw fa-user mr-2"></i>
                    <span>Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt mr-2"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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
                        <i class="fa fa-bars mr-2"></i>
                    </button>

                    <div class="mr-auto">
                        <h5 class="mt-0 mb-0 text-dark">Welcome, {{Auth::user()->name}}!</h5>
                        <span class="text-dark">
                            {{ App\Models\Role::getRoleNamebyID(Auth::user()->role_id) }}
                        </span>
                    </div>
                    
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ \Auth::user()->name }}</span>
                                @if(file_exists(public_path(Auth::user()->image)))
                                    <img class="img-profile rounded-circle" src="{{ url((Auth::user()->image) ? Auth::user()->image : 'uploads/user-photos/default.jpg') }}">
                                @else
                                    <img class="img-profile rounded-circle" src="{{asset('sb-admin')}}/img/undraw_profile.svg">
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400 mr-2"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <?php
                $b = '';
                if(isset($breadcrums)){
                    foreach($breadcrums as $key => $value){
                        $b .= '<a href="'.$value.'" style="color: #000;">'.ucwords($key).'</a> » ';
                    }
                ?>
                    <ul style="list-style: none; padding-left: 24px;">
                        <li>
                            <small style="font-size: 15px; font-weight: 500; color: #000; font-style: italic">{!!substr($b, 0, -3)!!}</small>
                        </li>
                    </ul>
                <?php } ?>
                

            @yield('content')

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="row">
                    <div class="copyright col-md-6 col-sm-6 col-6 text-left">
                        <span>&copy; TNI-Digital <?=date('Y')?></span>
                    </div>
                    <div class="copyright col-md-6 col-sm-6 col-6 text-right">
                        <span>{{ env('APP_VERSION') }}</span>
                    </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="{{url('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationBox" tabindex="-1" role="dialog" aria-labelledby="ConfirmationLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ConfirmationLabel">Are you sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Do you want to execute this action?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                    <a class="btn btn-danger" id="yes_confirmation">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{url('sb-admin')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{url('sb-admin')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{url('sb-admin')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{url('sb-admin')}}/js/sb-admin-2.min.js"></script>

    <script src="{{url('sb-admin')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{url('sb-admin')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script type='text/javascript' src="{{url('sb-admin')}}/vendor/jquery-inputmask/main.min.js"></script>
    <script type='text/javascript' src="{{url('sb-admin')}}/vendor/select-2/select2.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if($(window).width() < 600){
               $('#accordionSidebar').addClass('toggled');
            }else{
               $('#accordionSidebar').removeClass('toggled'); 
            }

            $('.select-2').select2();
            
            $('#dataTable').DataTable({
                "order": [],
                fixedHeader: true,
            });

            $(":input").inputmask();

            $(".phone").inputmask({
                mask: '9999-9999999',
                placeholder: ' ',
                showMaskOnHover: false,
                showMaskOnFocus: false,
                removeMaskOnSubmit: true,
            });

            $(".cnic").inputmask({
                mask: '99999-9999999-9',
                placeholder: ' ',
                showMaskOnHover: false,
                showMaskOnFocus: false,
                removeMaskOnSubmit: true,
            });

        });

        function deleteConfirmation(url){
            $('#yes_confirmation').attr('href', url)
            $("#confirmationBox").modal('show');
        }
        
        function imageChanged(id){
            var filename = $(id).val().split("\\").pop();
            $(id+"_label").addClass("selected").html(filename);
        }

        function multipleImageChanged(id){
            var files = $(id)[0].files;
            $(id+"_label").addClass("selected").html(files.length + " files selected!");
        }
    </script>

    @yield('footer')

</body>

</html>