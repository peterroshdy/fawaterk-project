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
                            <div class="col-sm-12">@lang('orders.Pending_Orders')</h4>
                                <p class="text-muted page-title-alt">@lang('orders.Here_is')</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->
                            <div class="col-lg-12">
                                <div class="card-box">
                                   
                                    <h4 class="text-dark header-title m-t-0">@lang('orders.Recent_Added')</h4>
                                    

                                    <div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>@lang('orders.Order_ID')</th>
                                                    <th>@lang('orders.Order_Items')</th>
                                                    <th>@lang('orders.Customer_Name')</th>
                                                    <th>@lang('orders.Shipping_Address')</th>
                                                    <th>@lang('orders.Phone')</th>
                                                    <th>@lang('orders.Payment_Method')</th>
                                                    <th>@lang('orders.Total')</th>
                                                    <th style="min-width: 80px;">@lang('orders.Create_At')</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($pending_orders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td><a href="{{ url('vendor/orders/pending/order/'.$order->id.'/items') }}">Items</a></td>
                                                    <td>{{ $order->user->name }}</td>
                                                    <td><span class="text-custom">{{ $order->shipping_address }}</span></td>
                                                    <td><span class="text-custom">{{ $order->phone }}</span></td>
                                                    <td><span class="text-custom">{{ $order->payment_method }}</span></td>
                                                    <td><span class="text-custom">{{ $order->total }}$</span></td>
                                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                                    
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- end col -->



                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    © 2018. All rights reserved.
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->


@endsection