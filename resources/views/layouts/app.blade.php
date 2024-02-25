<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name', '') }}</title>

    <link rel="stylesheet" href="{{ asset('justdo/vendors/ti-icons/css/themify-icons.css') }}?version={{config('constant.script_version')}}">
    <link rel="stylesheet" href="{{ asset('justdo/vendors/css/vendor.bundle.base.css') }}?version={{config('constant.script_version')}}">
    <link rel="stylesheet" href="{{ asset('justdo/vendors/font-awesome/css/font-awesome.min.css') }}?version={{config('constant.script_version')}}" />
    <link rel="stylesheet" href="{{ asset('justdo/css/style.css') }}?version={{config('constant.script_version')}}">

    @yield('Css')
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
</head>

<body class="sidebar-fixed">
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo me-5" href="{{url('/home')}}">
                    <img src="{{ asset('assets/images') }}/mominagrologo.png" alt="" style="width: 50px;"> <span class="display1 lead"> {{ config('app.name', 'Laravel') }}</span>
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{url('/home')}}">
                    <img src="{{ asset('assets/images') }}/mominagrologo.png" alt="" style="width: 100%;">
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="ti-layout-grid2"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group"></div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile">
                        <a class="nav-link" href="#">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item nav-profile">
                        |
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-flex">
                        <a class="nav-link" href="{{ url('/logout') }}">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="ti-layout-grid2"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                @include('admin.side_menu')
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    </div>
                </footer>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('justdo/vendors/js/vendor.bundle.base.js') }}?version={{config('constant.script_version')}}"></script>
    <script src="{{ asset('justdo/js/off-canvas.js') }}?version={{config('constant.script_version')}}"></script>
    <script src="{{ asset('justdo/js/hoverable-collapse.js') }}?version={{config('constant.script_version')}}"></script>
    <script src="{{ asset('justdo/js/template.js') }}?version={{config('constant.script_version')}}"></script>
    <script src="{{ asset('justdo/js/todolist.js') }}?version={{config('constant.script_version')}}"></script>
    <script src="{{ asset('justdo/js/dashboard.js') }}?version={{config('constant.script_version')}}"></script>
    @yield('JsScript')
</body>

</html>