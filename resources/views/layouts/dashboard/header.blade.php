<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Fawaterk | Dashboard</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        @yield('Styles')

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

        <script src="{{asset('main/js/modernizr.min.js')}}"></script>


    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="logo"><i class="icon-c-logo">@lang('header.FA')</i><span>@lang('header.Fawaterk')</span></a>
                        <!-- Image Logo here -->
                        <!--<a href="index.html" class="logo">-->
                            <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                            <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                        <!--</a>-->
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav navbar-right pull-right">

                                    <li class="dropdown top-menu-item-xs">
                                @if($storeInfo == '')
                                    <button onclick="location.href='{{ route("store.create") }}';" class="btn btn-success" style="margin-top: 12px;">
                                        <span class="btn-label"><i class="fa fa-shopping-cart"></i></span>@lang('header.Setup_Your')
                                    </button>
                                @else
                                    
                                    <a href="{{ url('store/'.$storeInfo->vendor_username.'') }}" target="_blank" class="waves-effect waves-light" aria-expanded="true"><i class="fa fa-shopping-cart"></i></a>
                                    
                                @endif

                                <li class="dropdown top-menu-item-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-flag"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="list-group slimscroll-noti notification-list">
                                           <!-- list item-->
                                           <a href="{{ url('/lang/ar') }}" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-flag noti-primary"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading p-t-10">@lang('header.Arabic')</h5>
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
                                                  <h5 class="media-heading">@lang('header.English')</h5>
                                               </div>
                                            </div>
                                         </a>

                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">{{ Auth::user()->name }}</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('vendor/profile') }}"><i class="ti-user m-r-10 text-custom"></i>@lang('header.Profile')</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            @lang('header.Logout')
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>
                                    </ul>
                                </li>
                                
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                            <li class="has_sub">
                                <a href="{{ url('/') }}" class="waves-effect"><i class="ti-home"></i> <span> @lang('header.Dashboard') </span></a>
                            </li>

                            @if($storeInfo != '')
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-layout-grid2"></i> <span>@lang('header.Products')</span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">        
                                    <li><a href="{{ route('product.create', $storeInfo->vendor_username) }}">@lang('header.New_Products')</a></li>
                                    <li><a href="{{ url('/vendor/products') }}">@lang('header.All_Products')</a></li>
                                </ul>
                            </li>
                            @endif


                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-layout-accordion-list"></i><span> @lang('header.Invoices') </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    
                                    <li><a href="{{ url('vendor/invoices/filterBy/all') }}">@lang('header.All_Invoices')</a></li>
                                    <li><a href="{{ url('vendor/invoice/paid') }}">@lang('header.Paid_Invoices')</a></li>
                                    <li><a href="{{ url('vendor/invoice/unpaid') }}">@lang('header.Unpaid_Invoices')</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i> <span> @lang('header.Customers') </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                	<li><a href="{{ url('vendor/customer/emailcheck') }}">@lang('header.Add_Customer')</a></li>
                                    <li><a href="{{ url('vendor/customers') }}">@lang('header.All_Customers')</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="{{ url('vendor/orders/pending') }}" class="waves-effect"><i class="ti-truck"></i> <span> @lang('header.Orders') </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-money"></i><span> @lang('header.Withdraw') </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('vendor/request-withdraw') }}">@lang('header.Request_Withdraw')</a></li>
                                    <li><a href="{{ url('vendor/withdraw-requests') }}">@lang('header.Withdraw_Requests')</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-layout-cta-right"></i><span> @lang('header.Tickets') </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('vendor/ticket/create') }}">@lang('header.New_Ticket')</a></li>
                                    <li><a href="{{ url('vendor/tickets') }}">@lang('header.My_Tickets')</a></li>
                                </ul>
                            </li>

                            @if($storeInfo != '')
                            <li class="has_sub">
                                    <a href="{{ url('vendor/store/settings') }}" class="waves-light"><i class="ti-shopping-cart-full"></i> <span> @lang('header.Store_Settings')</span></a>
                            </li>
                            @endif

                           

                           

                            

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- Content Start -->
            @yield('content')
            <!-- Content End -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{asset('main/js/jquery.min.js')}}"></script>
        <script src="{{asset('main/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('main/js/detect.js')}}"></script>
        <script src="{{asset('main/js/fastclick.js')}}"></script>

        <script src="{{asset('main/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('main/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('main/js/waves.js')}}"></script>
        <script src="{{asset('main/js/wow.min.js')}}"></script>
        <script src="{{asset('main/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('main/js/jquery.scrollTo.min.js')}}"></script>

        <script src="{{asset('main/plugins/peity/jquery.peity.min.js')}}"></script>

        <!-- jQuery  -->
        <script src="{{asset('main/plugins/waypoints/lib/jquery.waypoints.js')}}"></script>
        <script src="{{asset('main/plugins/counterup/jquery.counterup.min.js')}}"></script>



        <script src="{{asset('main/plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('main/plugins/raphael/raphael-min.js')}}"></script>

        <script src="{{asset('main/plugins/jquery-knob/jquery.knob.js')}}"></script>

        <script src="{{asset('main/pages/jquery.dashboard.js')}}"></script>

        <script src="{{asset('main/js/jquery.core.js')}}"></script>
        <script src="{{asset('main/js/jquery.app.js')}}"></script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });

                $(".knob").knob();

            });
        </script>

        @yield('Scripts')


    </body>
</html>