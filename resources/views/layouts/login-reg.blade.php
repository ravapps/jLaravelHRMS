<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset(Storage::url('uploads/logo')).'/favicon.png'}}" type="image" sizes="16x16">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'HRLab')}} - @yield('page-title')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

</head>
<body class="bg-default g-sidenav-show g-sidenav-pinned">
@yield('content')

<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>

<script src="{{ asset('assets/modules/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

</div>
</body>
</html>--}}




<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="icon" href="{{asset(Storage::url('uploads/logo')).'/favicon.png'}}" type="image" sizes="16x16">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'HRLab')}} - @yield('page-title')</title>
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset(Storage::url('uploads/logo')).'/favicon.png'}}">

    		<!-- App css -->
    		<link href="{{ asset('public/new_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    		<link href="{{ asset('public/new_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    		<link href="{{ asset('public/new_assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    		<link href="{{ asset('public/new_assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    		<!-- icons -->
    		<link href="{{ asset('public/new_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-fluid-pages loading pb-0">

      @yield('content')

        <!-- Vendor js -->
        <script src="{{ asset('public/new_assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('public/new_assets/js/app.min.js') }}"></script>

    </body>
</html>