<!DOCTYPE html>
<html lang="en">
@include('frontend::include.__head')
<body class="rock-auth-bg">
@include('notify::components.notify')  

@yield('content')

@include('frontend::include.__script')

</body>
</html>

