<!DOCTYPE html>
<head>
        <title>@yield('title')</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
    
        <!-- CSS Files-->
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('market/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('market/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('market/css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('market/css/hover.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('market/css/fontawesome-all.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('market/css/general.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('market/css/style.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('market/css/responsive.css') }}" />

</head>
<body>
   
        @yield('content')

         <!-- FOOTER -->
        <footer>
                <div class="container">
                <p class="float-left"><a href="#"><i class="fas fa-chevron-up"></i></a></p>
                <p>جميع الحقوق محفوظة © فواتيرك ٢٠١٨</p>
                </div>
        </footer>
        </div>
        <!-- JS Scripts-->
        <script src="{{ asset('market/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('market/js/popper.min.js') }}"></script>
        <script src="{{ asset('market/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('market/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('market/js/wow.min.js') }}"></script>
        <script src="{{ asset('market/js/main.js') }}"></script>

</body>
</html>