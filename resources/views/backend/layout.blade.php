<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VK CMS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/backend/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/backend/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/backend/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->

    <!-- ALERTFY JS -->
    <script src="/backend/custom/js/alertify/alertify.min.js"></script>
    <!-- include the style -->
    <link rel="stylesheet" href="/backend/custom/js/alertify/css/alertify.min.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="/backend/custom/js/alertify/css/themes/default.min.css" />
    <!-- ALERTFY JS -->

    <link rel="stylesheet" href="/backend/dist/css/skins/skin-blue.min.css">
    <!-- jQuery 3 -->
    <script src="/backend/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/backend/bower_components/jquery-ui/jquery-ui.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/backend/dist/js/adminlte.min.js"></script>

    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/backend/custom/css/custom.css">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{route("nedmin.Index")}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>VK</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>VK</b>CMS</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- /.messages-menu -->

                    <!-- Notifications Menu -->
                    <!-- Tasks Menu -->
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="/images/users/{{Auth::user()->user_file}}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="/images/users/{{Auth::user()->user_file}}" class="img-circle" alt="User Image">

                                <p>
                                    {{Auth::user()->name}}
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route("user.edit", Auth::user()->id)}}" class="btn btn-default btn-flat">Edit Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route("nedmin.Logout")}}" class="btn btn-default btn-flat">Sign Out</a>
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

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/images/users/{{Auth::user()->user_file}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENUS</li>
                <!-- Optionally, you can add icons to the links -->
                <li><a href="{{route("nedmin.Index")}}"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
                <li><a href="{{route("blog.index")}}"><i class="fa fa-paper-plane-o"></i> <span>Blogs</span></a></li>
                <li><a href="{{route("page.index")}}"><i class="fa fa-sticky-note"></i> <span>Pages</span></a></li>
                <li><a href="{{route("slider.index")}}"><i class="fa fa-image"></i> <span>Sliders</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-users"></i> <span>Administration</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route("user.index")}}"><i class="fa fa-user"></i> <span>Users</span></a></li>
                        <li><a href="{{route("settings.Index")}}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                    </ul>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- İÇERİKLERİ BURAYA GÖNDERECEĞİM -->
        @yield("content")

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            VK CMS
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2020 <a target="_blank" href="https://github.com/veyselkartalmis">Veysel Kartalmis</a>. </strong> All rights reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>

{{-- YAPILAN VE YÖNLENDİRİLEN TÜM İŞLEMLER İÇİN BURADA GERİ DÖNÜŞ MESAJI VERİYORUM --}}
    @if(session()->has("success"))
        <script> alertify.success("{{session("success")}}") </script>
    @endif
    @if(session()->has("error"))
        <script> alertify.error("{{session("error")}}") </script>
    @endif

{{-- TÜM VALIDATE HATALARINI YAKALAYIP ALERTIFY İLE BASIYORUM --}}
    @foreach($errors->all() as $error)
        <script> alertify.error("{{$error}}") </script>
    @endforeach
</body>
</html>
