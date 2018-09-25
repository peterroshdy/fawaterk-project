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
                                
                                <h4 class="page-title">Products</h4>
                                <p class="text-muted page-title-alt">Here is all your products</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			<h4 class="text-dark header-title m-t-0">Recent Added Products</h4>
                        			<div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                	<th>Product ID</th>
                                                    <th>Vendor Name</th>
                                                    <th>Product title</th>
                                                    <th>Product Price</th>
                                                    <th>Store Name</th>
                                                    <th>Category</th>
                                                    
                                                    <th style="min-width: 80px;">Create At</th>
                                                    <th style="min-width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            	@foreach($products as $product)
                                            	<tr>
                                                    <td><a href="##">{{ $product->id }}</a></td>
                                                    <td><span class="text-custom">{{ $product->vendor->name }}</span></td>
                                                    <td><span class="text-custom">{{ $product->title_en }}</span></td>
                                                    <td><span class="text-custom">{{ $product->price }}</span></td>
                                                    <td><span class="text-custom">{{ $product->store->store_name }}</span></td>
                                                    <td>{{ $product->category->name }}</td>
                                                    
                                                    <td>{{ $product->created_at }}</td>
                                                    <td>
                                                    	<a href="{{ url('admin/vendor/'.$product->vendor_username.'/product/'.$product->key.'/edit') }}" class="table-action-btn"><i class="md md-edit"></i></a>
                                                    	<a href="{{ url('admin/product/'.$product->id.'/delete') }}" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>
                                            	@endforeach

                                            </tbody>
                                        </table>
                                    </div>
                        		</div>
                        	</div>
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