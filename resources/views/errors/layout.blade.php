<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset(setting('site_favicon','global')) }}" type="image/x-icon"/>
    <link rel="icon" href="{{ asset(setting('site_favicon','global')) }}" type="image/x-icon"/>    
    <title>@yield('title')</title>
    <style>
 * {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'JetBrains Mono', monospace;
    color: white;
}

.dark-bg {
    background-image: url(/assets/frontend/theme_base/hardrock/images/bg/auth-bg.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
    min-height: 100vh;
    width: 100%;
}

.light-bg {
    background: #fff;
    color: #001219b3;
}

.unusual-page {
    width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.unusual-page .unusual-page-img {
    height: 250px;
    margin-bottom: 40px;
}

.site-btn.gradient-btn {
    font-size: 14px;
    font-weight: 800;
    color: var(--td-white);
    display: -webkit-inline-box;
    display:    -moz-inline-box;
    display: -ms-inline-flexbox;
    display: -webkit-inline-flex;
    display:     inline-flexbox;
    display:         inline-flex
    ;
    align-items: center;
    gap: 10px;
    background: linear-gradient(166deg, rgb(255 205 16) 0%, rgb(248 23 23) 100%);
    mix-blend-mode: normal;
    box-shadow: inset -4px 4px 10px rgba(255, 255, 255, .5);
    -webkit-border-radius: 1000px;
       -moz-border-radius: 1000px;
         -o-border-radius: 1000px;
        -ms-border-radius: 1000px;
            border-radius: 1000px;
    padding: 0 25px;
}
.site-btn {
    height: 45px;
    display: -webkit-inline-box;
    display:    -moz-inline-box;
    display: -ms-inline-flexbox;
    display: -webkit-inline-flex;
    display:     inline-flexbox;
    display:         inline-flex
    ;
    align-items: center;
    justify-content: center;
    padding: 10px 27px;
    -webkit-border-radius: 10px;
       -moz-border-radius: 10px;
         -o-border-radius: 10px;
        -ms-border-radius: 10px;
            border-radius: 10px;
    color: #000;
    background: var(--td-white);
    font-weight: 600;
    font-size: 14px;
    box-shadow: 0 0 2px rgba(0, 48, 73, .4);
    text-decoration: none;
}
@media (max-width: 991px) {
    .unusual-page .unusual-page-img {
        height: 150px;
    }
}

.unusual-page .title {
    font-size: 62px;
    font-weight: 700;
    margin-bottom: 30px;
}

@media (max-width: 991px) {
    .unusual-page .title {
        font-size: 42px;
    }
}

.unusual-page .description {
    font-size: 22px;
    font-weight: 300;
}

@media (max-width: 991px) {
    .unusual-page .description {
        font-size: 18px;
    }
}
    </style>
</head>

<body class="dark-bg">

<div class="unusual-page">
    @yield('content')
</div>

</body>
</html>


