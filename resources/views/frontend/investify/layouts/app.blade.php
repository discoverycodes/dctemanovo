<!DOCTYPE html>
<html lang="en">

@include('frontend::include.__head')

<body  @class([ 'dark-theme'=>session()->has('site-color-mode') ? session()->get('site-color-mode') == 'dark' : setting('default_mode','permission') == 'dark',
'rock-page-bg'
])>
@include('notify::components.notify')  

<!--Header Area-->
@include('frontend::include.__header')
<!--/Header Area End-->

@yield('content')

<!--Footer Area-->
@include('frontend::include.__footer')
<!--Footer Area End-->

@include('frontend::cookie.gdpr_cookie')

@include('frontend::include.__script')


</body>

</html>