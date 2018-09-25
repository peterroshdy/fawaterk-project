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
                                
                                <h4 class="page-title">Invoices</h4>
                                <p class="text-muted page-title-alt">Here is all your invoices</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			<h4 class="text-dark header-title m-t-0">Recent Added Invoices</h4>
                        			<div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                	<th>Key</th>
                                                    <th>Customer Name</th>
                                                    <th>Vendor Name</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    
                                                    <th style="min-width: 80px;">Create At</th>
                                                    <th style="min-width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            	@foreach($invoices as $invoice)
                                            	<tr>
                                                    <td><a href="{{ url('invoice/'.$invoice->invoice_key.'') }}">{{ $invoice->invoice_key }}</a></td>
                                                    <td><span class="text-custom">{{ $invoice->user->name }}</span></td>
                                                    <td><span class="text-custom">{{ $invoice->vendor->name }}</span></td>
                                                    <td><span class="text-custom">{{ $invoice->product }}</span></td>
                                                    <td><span class="text-custom">{{ $invoice->price }}</span></td>
                                                    <td>{{ $invoice->quantity }}</td>
                                                    
                                                    <td>{{ $invoice->created_at }}</td>
                                                    <td>
                                                    	<a href="#" class="table-action-btn" data-toggle="modal" data-target="#editModal"><i class="md md-edit"></i></a>
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