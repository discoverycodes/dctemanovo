<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('meta_keywords',setting('site_title','global'))">
    <meta name="description" content="@yield('meta_description',setting('site_title','global'))">
    <link rel="canonical" href="{{ url()->current() }}"/>
    <link rel="shortcut icon" href="{{ asset(setting('site_favicon','global')) }}" type="image/x-icon"/>
    <link rel="icon" href="{{ asset(setting('site_favicon','global')) }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('assets/global/css/simple-notify.min.css') }}"/>
    @stack('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/mckenziearts/laravel-notify/css/notify.css') }}"/>  
    @yield('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/theme_base/hardrock/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/theme_base/hardrock/css/fontawesome-pro.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/theme_base/hardrock/css/nice-select.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/theme_base/hardrock/css/datepicker-bs5.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/theme_base/hardrock/css/spacing.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/theme_base/hardrock/css/swiper.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/theme_base/hardrock/css/odometer-default.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/theme_base/hardrock/css/styles.css') }}?{{date('Y-m-d H:i:s')}}"/>
    <script src="{{ asset('assets/global/js/jquery.min.js') }}"></script>
    <style>
        {{ \App\Models\CustomCss::first()->css }}
    </style>

    <title>{{ setting('site_title', 'global') }} - @yield('title')</title>
</head>
