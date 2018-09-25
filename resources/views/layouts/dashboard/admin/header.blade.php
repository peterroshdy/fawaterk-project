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

        <link href="{{asset('main/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('main/css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('main/css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('main/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('main/css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('main/css/responsive.css')}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

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
                        <a href="{{ url('/') }}" class="logo"><i class="icon-c-logo">FA</i><span>Fawaterk</span></a>
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
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>
                                        <li class="list-group slimscroll-noti notification-list">
                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-diamond noti-primary"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-cog noti-warning"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">New settings</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-bell-o noti-custom"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">Updates</h5>
                                                    <p class="m-0">
                                                        <small>There are <span class="text-primary font-600">2</span> new updates available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-user-plus noti-pink"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">New user registered</h5>
                                                    <p class="m-0">
                                                        <small>You have 10 unread messages</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                            <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-diamond noti-primary"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-cog noti-warning"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">New settings</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="list-group-item text-right">
                                                <small class="font-600">See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>


                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">{{ Auth::user()->name }}</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
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
                                <a href="{{ url('/') }}" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="{{ url('/admin/withdraws') }}" class=""><i class="ti-layout-cta-right"></i> <span class="label label-pink pull-right">0</span><span> Withdraw Requests </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="{{ url('admin/users') }}" class=""><i class="ti-user"></i> <span class="label label-pink pull-right">0</span><span> Users </span></a>
                            </li>

                             <li class="has_sub">
                                <a href="{{ url('admin/invoices') }}" class=""><i class="ti-layout-accordion-list"></i> <span class="label label-pink pull-right">0</span><span> Invoices </span></a>
                             </li>

                             <li class="has_sub">
                                <a href="{{ url('admin/orders') }}" class=""><i class="ti-layout-accordion-list"></i> <span class="label label-pink pull-right">0</span><span> Product Orders </span></a>
                             </li>

                             <li class="has_sub">
                                <a href="{{ url('admin/roles') }}" class=""><i class="ti-layout-accordion-list"></i><span> Account Types </span></a>
                             </li>

                             <li class="has_sub">
                                <a href="{{ url('admin/products') }}" class=""><i class="ti-layout-accordion-list"></i> <span class="label label-pink pull-right">0</span><span> Products </span></a>
                             </li>

                             <li class="has_sub">
                                <a href="{{ url('admin/categories') }}" class=""><i class="ti-layout-accordion-list"></i> <span class="label label-pink pull-right">0</span><span> Categories </span></a>
                             </li>

                             <li class="has_sub">
                                <a href="{{ url('admin/tickets') }}" class=""><i class="ti-layout-accordion-list"></i> <span class="label label-pink pull-right">0</span><span> Tickets </span></a>
                             </li>

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




    </body>
</html>