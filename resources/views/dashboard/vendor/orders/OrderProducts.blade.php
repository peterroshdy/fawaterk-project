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
                                <h4 class="page-title">Order Items</h4>
                                <p class="text-muted page-title-alt">Here is all of the Pending Orders that need to be delivered</p>
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
                                                    <th>Product ID</th>
                                                    <th>Product Name</th>
                                                    <th>Color</th>
                                                    <th>Size</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Total</th>
                                                    <th>Ordered</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($order_items as $order)
                                                <tr>
                                                    <td>{{ $order->product->id }}</td>
                                                    <td>{{ $order->product->title }}</td>
                                                       
                                                    @if($order->color_id)
                                                    
                                                    <td>{{ $order->color->first()->color }}</td>

                                                    @else
                                                    <td>NONE</td>
                                                    @endif

                                                    @if($order->size_id)
                                                    
                                                    <td>{{ $order->size->first()->size }}</td>

                                                    @else
                                                    <td>NONE</td>
                                                    @endif

                                                    
                                                    <td>{{ $order->price }}$</td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td>{{ $order->total }}</td>
                                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                                    
                                                    
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ url('vendor/orders/pending') }}"><button class="btn btn-primary">Back to orders</button></a>

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