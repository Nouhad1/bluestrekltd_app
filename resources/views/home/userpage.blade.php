<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Bluestrek</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">
</head>
<body>
    <div class="hero_area">
        <!-- header -->
        @include('home.header')
        <!-- slider -->
        @include('home.slider')
    </div>

    @include('home.why')
    @include('home.new_arival')
    @include('home.product')
    @include('home.subscribe')
    @include('home.footer')

    <!-- JS : toujours en bas pour éviter les conflits -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <script src="{{ asset('home/js/custom.js') }}"></script>

    <!-- Optionnel : correctif au cas où Bootstrap JS bug -->
    <script>
        $(function() {
            $('.dropdown-toggle').dropdown();
        });
    </script>
</body>
</html>
