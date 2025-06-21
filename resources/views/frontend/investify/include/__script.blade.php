
<script src="{{ asset('assets/global/js/jquery-migrate.js') }}"></script>
<script src="{{ asset('assets/frontend/theme_base/hardrock/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/frontend/theme_base/hardrock/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/frontend/theme_base/hardrock/js/sidebar.js') }}"></script>
<script src="{{ asset('assets/frontend/theme_base/hardrock/js/datepicker-full.min.js') }}"></script>
<script src="{{ asset('assets/frontend/theme_base/hardrock/js/swiper.min.js') }}"></script>
<script src="{{ asset('assets/frontend/theme_base/hardrock/js/meanmenu.min.js') }}"></script>
<script src="{{ asset('assets/frontend/theme_base/hardrock/js/jquery.appear.min.js') }}"></script>
<script src="{{ asset('assets/frontend/theme_base/hardrock/js/odometer.min.js') }}"></script>
<script src="{{ asset('assets/frontend/theme_base/hardrock/js/main.js') }}"></script>
<script src="{{ asset('assets/global/js/simple-notify.min.js') }}"></script>

<script src="{{ asset('assets/frontend/js/cookie.js') }}"></script>
<script src="{{ asset('assets/global/js/custom.js') }}"></script>

@if (auth()->check() && auth()->user()->id > '200')
@if(setting('conten_protect','permission') == true)
<script src="{{ asset('assets/global/js/content-protector.js') }}"></script>
@endif
@endif

@include('global.__t_notify')


<script src="{{ asset('assets/vendor/mckenziearts/laravel-notify/js/notify.js') }}"></script>

@yield('script')
@stack('script')

@php
    $googleAnalytics = plugin_active('Google Analytics');
    $tawkChat = plugin_active('Tawk Chat');
    $fb = plugin_active('Facebook Messenger');
@endphp

@if($googleAnalytics)
    @include('frontend::plugin.google_analytics',['GoogleAnalyticsId' => json_decode($googleAnalytics?->data,true)['app_id']])
@endif
@if($tawkChat)
    @include('frontend::plugin.tawk',['data' => json_decode($tawkChat->data, true)])
@endif
@if($fb)
    @include('frontend::plugin.fb',['data' => json_decode($fb->data, true)])
@endif



