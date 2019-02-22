<!DOCTYPE html>
<html lang="en">
<head>
    <title>Setup</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('setup-assets/images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('setup-assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('setup-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('setup-assets/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('setup-assets/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('setup-assets/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('setup-assets/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('setup-assets/css/main.css')}}">


    <!--===============================================================================================-->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

<div id="app">
    <div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset('setup-assets/images/img-01.png')}}" alt="IMG">
            </div>

            @yield('content')


        </div>
    </div>
</div>
</div>



<!--===============================================================================================-->
<script src="{{asset('setup-assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('setup-assets/vendor/tilt/tilt.jquery.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('setup-assets/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('setup-assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('setup-assets/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->

<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{asset('setup-assets/js/main.js')}}"></script>

</body>
</html>