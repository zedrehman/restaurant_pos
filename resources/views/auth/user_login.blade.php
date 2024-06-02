<!DOCTYPE html>
<html lang="en" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', '') }}</title>
    <link rel="stylesheet" href="{{ asset('justdo/vendors/ti-icons/css/themify-icons.css') }}?version={{config('constant.script_version')}}">
    <link rel="stylesheet" href="{{ asset('justdo/vendors/css/vendor.bundle.base.css') }}?version={{config('constant.script_version')}}">
    <link rel="stylesheet" href="{{ asset('justdo/css/style.css') }}?version={{config('constant.script_version')}}">
</head>

<body class="sidebar-fixed">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="row">
                                <div class="col-sm-5" style="vertical-align: middle;">
                                    <div class="brand-logo">
                                        <img src="{{ asset('img') }}/login_banner.png" alt="" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <h6 class="font-weight-light">User Login</h6>
                                    @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                    <form class="pt-3" method="POST" action="{{ url('/login/user') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>