@extends('layouts/dashboard/header')
@section('content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    
                    <h4 class="page-title">@lang('Dashboard.Dashboard')</h4>
                    <p class="text-muted page-title-alt">@lang('Dashboard.Dashboard_Desc')</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="widget-bg-color-icon card-box fadeInDown animated">
                        <div class="bg-icon bg-icon-info pull-left">
                            <i class="md md-attach-money text-info"></i>
                        </div>
                        
                        <div class="text-right">
                            <h3 class="text-dark"><b class="counter">{{ $nvoices_count }}</b></h3>
                            <p class="text-muted">@lang('Dashboard.Total_Invoices')</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-pink pull-left">
                            <i class="md md-add-shopping-cart text-pink"></i>
                        </div>
                        <div class="text-right">
                            @if($withdraw != '')
                            <h3 class="text-dark"><b class="counter">{{ $withdraw->total }}</b>$</h3>
                            @else
                            <h3 class="text-dark"><b class="counter">0</b>$</h3>
                            @endif
                            <p class="text-muted">@lang('Dashboard.Available_Cash')</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-purple pull-left">
                            <i class="md md-equalizer text-purple"></i>
                        </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b class="counter">{{ $orders_count }}</b></h3>
                            <p class="text-muted">@lang('Dashboard.Pending_Orders')</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-success pull-left">
                            <i class="md md-remove-red-eye text-success"></i>
                        </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b class="counter">
                            @if($store_visits)
                            {{ $store_visits->visits }}
                            @else
                            0
                            @endif
                            </b></h3>
                            <p class="text-muted">@lang("Dashboard.Today's_Visits")</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="card-box">
                        <a href="{{ url('vendor/customers') }}" class="pull-right btn btn-default btn-sm waves-effect waves-light">@lang('Dashboard.View_All')</a>
                        <h4 class="text-dark header-title m-t-0">@lang('Dashboard.Recent_Customers')</h4>
                        <p class="text-muted m-b-30 font-13">
                            @lang('Dashboard.Lat_reg_cus')
                        </p>
                        @if(count( $customers ))
                        <div class="table-responsive">
                            <table class="table table-actions-bar m-b-0">
                                <thead>
                                    <tr>
                                        <th>@lang('Dashboard.Customer_ID')</th>
                                        <th>@lang('Dashboard.customer_Name')</th>
                                        <th>@lang('Dashboard.Customer_Phone')</th>
                                        <th>@lang('Dashboard.Created_At')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td><span class="text-custom">{{ $customer->created_at }}</span></td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <h4 class="text-center">You don't have any customers <i class="fa fa-frown-o"></i></h4>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-box">
                        <a href="{{ url('vendor/orders/pending') }}" class="pull-right btn btn-default btn-sm waves-effect waves-light">@lang('Dashboard.View_All')</a>
                        <h4 class="text-dark header-title m-t-0">@lang('Dashboard.Recent_Orders')</h4>
                        <p class="text-muted m-b-30 font-13">
                            @lang('Dashboard.Lat_reg_cus')
                        </p>
                        @if(count( $pending_orders ))
                        <div class="table-responsive">
                            <table class="table table-actions-bar m-b-0">
                                <thead>
                                    <tr>
                                        <th>@lang('Dashboard.Order_ID')</th>
                                        <th>@lang('Dashboard.Order_Items')</th>
                                        <th>@lang('Dashboard.customer_Name')</th>
                                        <th>@lang('Dashboard.Payment_Method')</th>
                                        <th>@lang('Dashboard.Total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($pending_orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td><a href="{{ url('vendor/orders/pending/order/'.$order->id.'/items') }}">@lang('Dashboard.Items')</a></td>
                                        <td>{{ $order->user->name }}</td>
                                        
                                        <td><span class="text-custom">{{ $order->payment_method }}</span></td>
                                        <td><span class="text-custom">{{ $order->total }}$</span></td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <h4 class="text-center">You don't have any orders <i class="fa fa-frown-o"></i></h4>
                        @endif
                    </div>
                </div>
            </div>
            </div> <!-- container -->
            </div> <!-- content -->
            <footer class="footer text-right">
                © 2018. All rights reserved.
            </footer>
        </div>
    </div>
    <!-- END wrapper -->
    @endsection