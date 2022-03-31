<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{url('sb-admin')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{url('sb-admin')}}/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="{{url('sb-admin')}}/css/custom.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        @if(Session::get("message") && Session::get("class"))
                            <p class="alert alert-{{Session::get('class')}} text-center rounded-0">{{ Session::get("message") }}</p>
                        @endif
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12 m-auto">
                                <div class="py-5 px-5">
                                    <!-- <div class="text-center">
                                        <img src="{{ asset('uploads/app-icon.png') }}" class="img-fluid" style="width: 100px; margin-bottom: 10px;">
                                    </div> -->
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
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

    <script type='text/javascript' src="{{url('sb-admin')}}/vendor/jquery-inputmask/main.min.js"></script>

    <script type="text/javascript">
        $(":input").inputmask();

        $(".phone").inputmask({
            mask: '9999-9999999',
            placeholder: ' ',
            showMaskOnHover: false,
            showMaskOnFocus: false,
            removeMaskOnSubmit: true,
        });
    </script>

</body>

</html>