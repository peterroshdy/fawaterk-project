<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=
        ice-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <title>@Lang('Common.Fawaterk') | @yield('Title')</title>
        
        @if(Config::get('app.locale') == 'ar')
            <link href="{{ asset('/rtl/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/core.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/components.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/icons.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/pages.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('/rtl/css/menu.css') }}" rel="stylesheet" type="text/css" />
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

                <!-- Navigation Bar-->
                <header id="topnav">
                    <div class="topbar-main">
                        <div class="container container-alt">
                            <div class="">
                                <ul class="nav navbar-nav hidden-xs">

                                    <li><a href="{{ url('customer/home') }}" class="waves-effect waves-light"><b>Fawaterk</b></a></li>

                                </ul>
    
    
                                <ul class="nav navbar-nav navbar-right pull-right">
                                 
                                    <li class="dropdown top-menu-item-xs">
                                        <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><i class="icon-flag"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-lg">
                                            <li class="list-group slimscroll-noti notification-list">
                                               <!-- list item-->
                                               <a href="{{ url('/lang/ar') }}" class="list-group-item">
                                                  <div class="media">
                                                     <div class="pull-left p-r-10">
                                                        <em class="fa fa-flag noti-primary"></em>
                                                     </div>
                                                     <div class="media-body">
                                                        <h5 class="media-heading p-t-10">@lang('Customer.Arabic')</h5>
                                                     </div>
                                                  </div>
                                               </a>
    
                                               <!-- list item-->
                                               <a href="{{ url('/lang/en') }}" class="list-group-item">
                                                <div class="media">
                                                   <div class="pull-left p-r-10">
                                                      <em class="fa fa-flag noti-primary"></em>
                                                   </div>
                                                   <div class="media-body p-t-10">
                                                      <h5 class="media-heading">@lang('Customer.English')</h5>
                                                   </div>
                                                </div>
                                             </a>
    
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="dropdown top-menu-item-xs">
                                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">{{ Auth::user()->name }}</a>
                                        <ul class="dropdown-menu">

                                            <li><a href="{{ url('/customer/edit') }}"><i class="ti-user m-r-10 text-custom"></i>@lang('Customer.edit_profile')</a></li>
                                      
                                            <li class="divider"></li>
                                            <li><a href="{{ url('/logout') }}"><i class="ti-power-off m-r-10 text-danger"></i>@lang('Customer.logout')</a></li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!--/.nav-collapse -->
                        </div>
                    </div>
        
                    <div class="navbar-custom">
                        <div class="container container-alt ">
                            <div id="navigation">
                                <!-- Navigation Menu-->
                                <ul class="navigation-menu">
                                    <li class="has-submenu">

                                        <a href="{{ url('customer/home') }}"><i class="md md-dashboard"></i>@lang('Customer.Home')</a>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="{{ url('customer/invoices') }}"><i class="md md-receipt"></i>@lang('Customer.Invoices')</a>
                                        <ul class="submenu">
                                            <li><a href="{{ url('customer/invoices') }}">@lang('Customer.All_Invoices')</a></li>
                                            <li><a href="{{ url('customer/invoices/paid') }}">@lang('Customer.Paid_Invoices')</a></li>
                                            <li><a href="{{ url('customer/invoices/unpaid') }}">@lang('Customer.Unpaid_Invoices')</a></li>

                                        </ul>
                                    </li>
        
                    <!--
                                    <li class="has-submenu">
                                        <a href="{{ url('/customer/tickets') }}"><i class="md md-message "></i>@lang('Customer.Tickets')</a>
                                        <ul class="submenu">
                                            <li><a href="{{ url('/customer/tickets/new') }}">@lang('Customer.New_Ticket')</a></li>
                                            <li><a href="{{ url('/customer/tickets') }}">@lang('Customer.All_Tickets')</a></li>
                                        </ul>
                                    </li>
                                -->

                                    <li class="has-submenu">

                                        <a href="{{ url('customer/stores') }}"><i class="md-add-shopping-cart"></i>@lang('Customer.Stores')</a>
                                    </li>
                                </ul>
                                <!-- End navigation menu        -->
                            </div>
                        </div> <!-- end container -->
                    </div> <!-- end navbar-custom -->
                </header>
                <!-- End Navigation Bar-->
        
        
                <div class="wrapper">
                    <div class="container">
        
                      <!-- Page-Title -->
                        <div class="row">
                            @yield('MainContent')
                        </div>
        
                        <!-- Demo only -->
                        <div class="" style="height: 100px;"></div>
        
                        <!-- Footer -->
                        <footer class="footer text-right">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-6">
                                        © 2018. All rights reserved.
                                    </div>                           

                                </div>
                            </div>
                        </footer>
                        <!-- End Footer -->
        
                    </div> <!-- end container -->
                </div>
                <!-- end wrapper -->


                
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