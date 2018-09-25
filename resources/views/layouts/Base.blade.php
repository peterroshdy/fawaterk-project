<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <title>@Lang('Common.Fawaterk') | @yield('Title')</title>
        
        @if(Config::get('app.locale') == 'ar')
            <link href="{{ asset('/rtl/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/core.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/components.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/icons.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/pages.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/main/css/menu.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/responsive.css') }}" rel="stylesheet" type="text/css" />
        @else
            <link href="{{ asset('main/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/core.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/components.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/icons.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/pages.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/menu.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('main/css/responsive.css') }}" rel="stylesheet" type="text/css" />
        @endif

        @yield('Styles')
        
        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <script src="{{ asset('main/js/modernizr.min.js') }}"></script>
        
    </head>
    <body>

            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">

                        @yield('MainContent')

                    </div>
                </div>

                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                © 2016. All rights reserved.
                            </div>
                            <div class="col-xs-6">
                                <ul class="pull-right list-inline m-b-0">
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                    <li>
                                        <a href="#">Help</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div>


                
    <!-- Javascripts  -->
    <script>var resizefunc = [];</script>
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

    @yield('Scripts')
    
    </body>
</html>