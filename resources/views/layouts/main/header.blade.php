<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Fawaterk - @yield('title')</title>

        @if(Config::get('app.locale') == 'ar')
            <link href="{{ asset('/rtl/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/core.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/components.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/icons.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/pages.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/responsive.css') }}" rel="stylesheet" type="text/css" />
        @else
            <link href="{{ asset('main/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/core.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/components.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/icons.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/pages.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/responsive.css') }}" rel="stylesheet" type="text/css" />
        @endif

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{ asset('main/js/modernizr.min.js') }}"></script>
        
    </head>
    <body>

    @yield('content')

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ asset('main/js/jquery.min.js') }}"></script>
        <script src="{{ asset('main/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('main/js/detect.js') }}"></script>
        <script src="{{ asset('main/js/fastclick.js') }}"></script>
        <script src="{{ asset('main/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('main/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('main/js/waves.js') }}"></script>
        <script src="{{ asset('main/js/wow.min.js') }}"></script>
        <script src="{{ asset('main/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('main/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('main/js/jquery.core.js') }}"></script>
        <script src="{{ asset('main/js/jquery.app.js') }}"></script>
        <script src="{{ asset('main/js/main.js') }}"></script>
    
    </body>
</html>