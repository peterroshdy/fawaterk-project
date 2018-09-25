@extends('layouts/dashboard/admin/header')
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
                                <h4 class="page-title">Orders</h4>
                                <p class="text-muted page-title-alt">Here is all of the Orders</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                            <div class="col-lg-12">
                                <div class="card-box">
                                   
                                    <h4 class="text-dark header-title m-t-0">Recent Added Orders</h4>
                                    

                                    <div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Order Items</th>
                                                    <th>Customer ID</th>
                                                    <th>Shipping Address</th>
                                                    <th>Phone</th>
                                                    <th>Payment Method</th>
                                                    <th>Total</th>
                                                    <th style="min-width: 80px;">Create At</th>
                                                    <th style="min-width: 80px;">Action</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($orders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td><a href="{{ url('/orders/pending/order/'.$order->id.'/items') }}">Items</a></td>
                                                    <td>{{ $order->customer_id }}</td>
                                                    <td><span class="text-custom">{{ $order->shipping_address }}</span></td>
                                                    <td><span class="text-custom">{{ $order->phone }}</span></td>
                                                    <td><span class="text-custom">{{ $order->payment_method }}</span></td>
                                                    <td><span class="text-custom">{{ $order->total }}$</span></td>
                                                    <td>{{ $order->created_at }}</td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn" data-toggle="modal" data-target="#deleteModal"><i class="md md-close"></i></a>
                                                    </td>
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