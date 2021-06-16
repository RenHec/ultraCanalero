<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ __('Ultra Canaleros') }}</title>
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/favicon.ico">
        <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.ico">

        <!-- CSS Files -->
        <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
        <link href="{{ asset('material') }}/css/material-ultra.css" rel="stylesheet" />
        <link href="{{ asset('material') }}/css/material-new-form.css" rel="stylesheet" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="all" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css">
        {!! RecaptchaV3::initJs() !!}
    </head>
    <body style="background-image: url('{{ asset('material') }}/img/login.webp'); background-size: cover; background-position: top center;align-items: center;">
        @yield('content')

        <!--   Core JS Files   -->
        <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
        <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
        <script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @stack('js')
    </body>
</html>
