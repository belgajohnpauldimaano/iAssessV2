<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{--
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    --}}
    
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b>LTE</span>
            </a>


            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="dist/img/uaser2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ session('USER_FULLNAME') }}</span>
                            </a>

                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="dist/img/auser2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>
                                        {{ session('USER_FULLNAME') }}
                                        <small>{{ session('USER_TYPE') }}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                {{--<li class="user-body">
                                    <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                    </div>
                                    <!-- /.row -->
                                </li>--}}
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat" 
                                                    onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">Sign out</a>
                                                            
                                        <form id="logout-form" action="{{ route('userlogout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>


                        </li>

                    </ul>
                </div>

            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">Navigations</li>
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Dashboard</span></a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Director</span></a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Practicum Coordinator</span></a></li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('page-title')
            <small>@yield('page-description')</small>
            </h1>
            <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- Main content -->

        </div>
        <!-- Content Wrapper. Contains page content -->


        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.8
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>
    </div>



    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>


    @yield('scripts')
    <!-- Scripts -->
    {{--
    <script src="{{ asset('js/app.js') }}"></script>
    --}}
</body>
</html>
