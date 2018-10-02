<!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="{{path_image().allsetting()['favicon']}}"/>
    <title> {{allsetting()['app_title']}}:: @yield('title')</title>
    <meta name="keywords" content="HTML5 Admin Template"/>
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
          rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('asset/vendor/bootstrap/css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{asset('asset/vendor/animate/animate.css')}}">
    <link rel="stylesheet" href="{{asset('asset/vendor/font-awesome/css/font-awesome.css')}}"/>
    <link rel="stylesheet" href="{{asset('asset/vendor/magnific-popup/magnific-popup.css')}}"/>
    <link rel="stylesheet" href="{{asset('asset/css/jquery.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('asset/css/responsive.dataTables.min.css')}}"/>
{{--<link rel="stylesheet" href="{{asset('asset/vendor/datatables-metronic/datatables.min.css')}}"/>--}}

@yield('page_style')
<!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/theme.css')}}"/>
    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/skins/default.css')}}"/>
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/custom.css')}}">
    <!-- Head Libs -->
    <script src="{{asset('asset/vendor/modernizr/modernizr.js')}}"></script>
    @yield('style')
</head>
<body>
<section class="body">
    <!-- start: header -->
    <header class="header">
        <div class="logo-container">
            <a href="{{route('userDashboard')}}" class="logo">
                <img @if(!empty(allsetting()['logo'])) src="{{path_image().allsetting()['logo']}}" @else src="{{asset('asset/img/logo.png')}}" @endif width="75" height="35" alt="Porto Admin"/>
            </a>
            <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
                 data-fire-event="sidebar-left-opened">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <!-- start: search & user box -->
        <div class="header-right">
            <span class="separator"></span>

            <span class="separator"></span>

            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">

                    <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                        <span class="name">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</span>
                    </div>

                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled mb-2">
                        <li class="divider"></li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{route('user',Auth::user()->id)}}"><i class="fa fa-user"></i>
                                {{__('Profile')}}</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{route('logout')}}"><i class="fa fa-power-off"></i>
                                {{__('Logout')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: search & user box -->
    </header>
    <!-- end: header -->

